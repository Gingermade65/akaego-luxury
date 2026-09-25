<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your shopping cart is empty.');
        }

        $subtotal = $this->cartService->getSubtotal();
        $shippingFee = $subtotal > 500 ? 0.00 : 35.00; // Complimentary shipping over $500
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact('cart', 'subtotal', 'shippingFee', 'total'));
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
            'customer_phone'       => 'nullable|string|max:50',
            'shipping_address'    => 'required|string|max:255',
            'shipping_city'       => 'required|string|max:100',
            'shipping_state'      => 'nullable|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country'    => 'required|string|max:100',
            'payment_method'      => 'required|string|in:stripe,cod',
        ]);

        $subtotal = $this->cartService->getSubtotal();
        $shippingFee = $subtotal > 500 ? 0.00 : 35.00;
        $total = $subtotal + $shippingFee;

        $order = DB::transaction(function () use ($validated, $cart, $subtotal, $shippingFee, $total) {
            $order = Order::create([
                'order_number'         => Order::generateOrderNumber(),
                'user_id'              => auth()->id(),
                'customer_name'        => $validated['customer_name'],
                'customer_email'       => $validated['customer_email'],
                'customer_phone'       => $validated['customer_phone'] ?? null,
                'shipping_address'     => $validated['shipping_address'],
                'shipping_city'        => $validated['shipping_city'],
                'shipping_state'       => $validated['shipping_state'] ?? null,
                'shipping_postal_code' => $validated['shipping_postal_code'],
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

        // Clear cart after successful order creation
        $this->cartService->clear();

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}