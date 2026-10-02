<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected CartService $cartService;
    protected PaystackService $paystackService;

    public function __construct(CartService $cartService, PaystackService $paystackService)
    {
        $this->cartService = $cartService;
        $this->paystackService = $paystackService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your shopping cart is empty.');
        }

        $cartItems = $cart;
        $subtotal = $this->cartService->getSubtotal();
        
        // Shipping Fee Logic: ₦2,000 below ₦100,000; Free for ₦100,000 and above
        $shippingFee = $subtotal >= 100000 ? 0.00 : 2000.00;
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact('cart', 'cartItems', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request)
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'customer_name'        => 'required|string|max:255',
            'customer_email'       => 'required|email|max:255',
            'customer_phone'       => 'required|string|max:50',
            'shipping_address'     => 'required|string|max:255',
            'shipping_city'        => 'required|string|max:100',
            'shipping_state'       => 'required|string|max:100',
            'shipping_postal_code' => 'nullable|string|max:20',
            'shipping_country'     => 'required|string|max:100',
            'payment_method'       => 'required|string|in:paystack,cod',
        ]);

        $subtotal = $this->cartService->getSubtotal();
        
        // Shipping Fee Logic: ₦2,000 below ₦100,000; Free for ₦100,000 and above
        $shippingFee = $subtotal >= 100000 ? 0.00 : 2000.00;
        $total = $subtotal + $shippingFee;

        $order = DB::transaction(function () use ($validated, $cart, $subtotal, $shippingFee, $total) {
            $order = Order::create([
                'order_number'         => Order::generateOrderNumber(),
                'user_id'              => auth()->id(),
                'customer_name'        => $validated['customer_name'],
                'customer_email'       => $validated['customer_email'],
                'customer_phone'       => $validated['customer_phone'],
                'shipping_address'     => $validated['shipping_address'],
                'shipping_city'        => $validated['shipping_city'],
                'shipping_state'       => $validated['shipping_state'],
                'shipping_postal_code' => $validated['shipping_postal_code'] ?? '100001',
                'shipping_country'     => $validated['shipping_country'],
                'subtotal'             => $subtotal,
                'tax'                  => 0.00,
                'shipping_fee'         => $shippingFee,
                'total'                => $total,
                'status'               => 'pending',
                'payment_status'       => 'unpaid',
                'payment_method'       => $validated['payment_method'],
            ]);

            foreach ($cart as $productId => $details) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $productId,
                    'product_name' => $details['name'],
                    'price'        => $details['price'],
                    'quantity'     => $details['quantity'],
                    'total'        => $details['price'] * $details['quantity'],
                ]);
            }

            return $order;
        });

       // Paystack Payment Redirect
        if ($validated['payment_method'] === 'paystack') {
            try {
                $paystackData = [
                    'amount'       => (int) ($order->total * 100), // Paystack accepts amount in kobo
                    'email'        => $order->customer_email,
                    'currency'     => 'NGN',
                    'reference'    => 'AKG-' . Str::upper(Str::random(10)),
                    'callback_url' => route('paystack.callback'),
                    'metadata'     => [
                        'order_number' => $order->order_number,
                    ],
                ];

                $response = $this->paystackService->initializeTransaction($paystackData);

                if (isset($response['data']['authorization_url'])) {
                    return redirect($response['data']['authorization_url']);
                }

                // Log unexpected API response internally
                \Log::error('Paystack initialization response invalid: ', (array) $response);

                return redirect()->route('checkout.index')->with('error', 'Unable to initiate secure payment portal. Please re-submit or contact concierge support.');

            } catch (\Exception $e) {
                // Log technical error details for developers
                \Log::error('Paystack connection exception: ' . $e->getMessage());

                // Client-facing luxury message
                return redirect()->route('checkout.index')->with('error', 'We encountered a temporary network delay connecting to our payment gateway. Please re-submit your acquisition or select an alternative payment method.');
            }
        }

        // Cash / Transfer on Delivery — Send Confirmation Email before clearing & redirecting
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order->load('items')));
        } catch (\Exception $e) {
            \Log::error('Order confirmation email failed: ' . $e->getMessage());
        }

        $this->cartService->clear();
        return redirect()->route('checkout.success', $order->order_number);
    }

    public function handlePaystackCallback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('checkout.index')->with('error', 'No reference supplied.');
        }

        try {
            $payment = $this->paystackService->verifyTransaction($reference);

            if ($payment['status'] && $payment['data']['status'] === 'success') {
                $orderNumber = $payment['data']['metadata']['order_number'] ?? null;

                if ($orderNumber) {
                    $order = Order::where('order_number', $orderNumber)->firstOrFail();
                    $order->update([
                        'payment_status' => 'paid',
                        'status'         => 'processing',
                    ]);

                    // Send Confirmation Email for Paystack Success
                    try {
                        Mail::to($order->customer_email)->send(new OrderConfirmationMail($order->load('items')));
                    } catch (\Exception $e) {
                        \Log::error('Paystack order confirmation email failed: ' . $e->getMessage());
                    }

                    $this->cartService->clear();
                    return redirect()->route('checkout.success', $order->order_number);
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'Payment verification failed.');
        }

        return redirect()->route('checkout.index')->with('error', 'Payment was not successful.');
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}