<x-app-layout title="Order Confirmation | AKAEGO LUXURY & BOUTIQUE">
    <div class="max-w-3xl mx-auto px-6 py-20 text-center space-y-8">
        <div class="w-16 h-16 border-2 border-luxury-gold text-luxury-gold flex items-center justify-center rounded-full mx-auto text-2xl font-serif">
            ✓
        </div>

        <h1 class="font-serif text-3xl tracking-widest text-luxury-gold uppercase">Thank You For Your Order</h1>
        <p class="text-luxury-cream/80 text-sm max-w-md mx-auto leading-relaxed">
            Your order <span class="text-luxury-gold font-mono font-bold">{{ $order->order_number }}</span> has been placed successfully. A detailed confirmation has been prepared for your records.
        </p>

        <div class="bg-luxury-charcoal/40 border border-luxury-gold/20 p-6 text-left space-y-4 max-w-lg mx-auto">
            <h2 class="font-serif text-sm uppercase tracking-widest text-luxury-gold border-b border-luxury-gold/20 pb-2">
                Order Overview
            </h2>

            <div class="text-xs space-y-2 text-luxury-cream/80">
                <div class="flex justify-between">
                    <span>Order Reference:</span>
                    <span class="font-mono text-luxury-gold">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Recipient:</span>
                    <span>{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Shipping To:</span>
                    <span>{{ $order->shipping_city }}, {{ $order->shipping_country }}</span>
                </div>
                <div class="flex justify-between font-bold border-t border-luxury-gold/10 pt-2 text-luxury-gold">
                    <span>Total Amount:</span>
                    <span class="font-mono">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="pt-4">
            <a href="{{ route('products.index') }}"
               class="inline-block bg-luxury-gold text-luxury-black px-8 py-3 uppercase tracking-widest text-xs font-semibold hover:bg-luxury-champagne transition">
                Continue Exploring
            </a>
        </div>
    </div>
</x-app-layout>