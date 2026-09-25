<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $subtotal = $this->cartService->getSubtotal();
        $itemCount = $this->cartService->getItemCount();

        return view('cart.index', compact('cart', 'subtotal', 'itemCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:10',
        ]);

        $quantity = $request->input('quantity', 1);
        $this->cartService->add($request->product_id, $quantity);

        return redirect()->route('cart.index')->with('success', 'Piece successfully added to your shopping bag.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $this->cartService->update((int) $id, (int) $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Shopping bag updated.');
    }

    public function destroy($id)
    {
        $this->cartService->remove((int) $id);

        return redirect()->route('cart.index')->with('success', 'Piece removed from your shopping bag.');
    }
}