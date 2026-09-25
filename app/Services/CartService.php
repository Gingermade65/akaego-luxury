<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    protected string $sessionKey = 'akaego_cart';

    /**
     * Get all cart items with detailed calculations.
     */
    public function getCart(): array
    {
        return session()->get($this->sessionKey, []);
    }

    /**
     * Add a product to the cart or update its quantity.
     */
    public function add(int $productId, int $quantity = 1): array
    {
        $cart = $this->getCart();
        $product = Product::with('primaryImage', 'category')->findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'sku' => $product->sku,
                'category' => $product->category->name ?? 'Collection',
                'image' => $product->primaryImage ? $product->primaryImage->image_path : null,
            ];
        }

        session()->put($this->sessionKey, $cart);
        return $cart;
    }

    /**
     * Update item quantity directly.
     */
    public function update(int $productId, int $quantity): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                return $this->remove($productId);
            }
            $cart[$productId]['quantity'] = $quantity;
            session()->put($this->sessionKey, $cart);
        }

        return $cart;
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(int $productId): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put($this->sessionKey, $cart);
        }

        return $cart;
    }

    /**
     * Empty the entire shopping cart.
     */
    public function clear(): void
    {
        session()->forget($this->sessionKey);
    }

    /**
     * Calculate cart subtotal.
     */
    public function getSubtotal(): float
    {
        $cart = $this->getCart();
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0.00);
    }

    /**
     * Total count of distinct or accumulated items.
     */
    public function getItemCount(): int
    {
        $cart = $this->getCart();
        return array_reduce($cart, function ($count, $item) {
            return $count + $item['quantity'];
        }, 0);
    }
}