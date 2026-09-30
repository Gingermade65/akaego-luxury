<x-app-layout>
    <x-slot name="title">Order Confirmation | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="max-w-4xl mx-auto px-6 py-16">
        <!-- Success Banner -->
        <div class="text-center mb-12 border-b border-luxury-gold/20 pb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-luxury-gold/10 border border-luxury-gold mb-6">
                <svg class="w-8 h-8 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <span class="block text-xs uppercase tracking-widest text-luxury-gold font-semibold mb-2">Acquisition Confirmed</span>
            <h1 class="font-serif text-3xl md:text-4xl text-luxury-cream">Thank You for Your Order</h1>
            <p class="text-xs text-luxury-cream/60 mt-3 uppercase tracking-wider">
                Order Reference: <span class="text-luxury-gold font-mono font-semibold">{{ $order->order_number }}</span>
            </p>
        </div>

        <!-- Receipt Card -->
        <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl space-y-8 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-luxury-gold/10 pb-6">
                <div>
                    <h2 class="font-serif text-xl text-luxury-gold tracking-wide">Acquisition Receipt</h2>
                    <p class="text-xs text-luxury-cream/50 mt-1">Date: {{ $order->created_time ? \Carbon\Carbon::parse($order->created_time)->format('F j, Y, g:i a') : now()->format('F j, Y, g:i a') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs uppercase tracking-wider text-luxury-cream/60">Payment Status:</span>
                    <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider border {{ $order->payment_status === 'paid' ? 'bg-emerald-950/60 border-emerald-500/50 text-emerald-300' : 'bg-amber-950/60 border-amber-500/50 text-amber-300' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <!-- Client & Delivery Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs text-luxury-cream/80 border-b border-luxury-gold/10 pb-6">
                <div>
                    <p class="uppercase tracking-widest text-luxury-gold font-semibold mb-2">Private Client</p>
                    <p class="font-medium text-luxury-cream">{{ $order->customer_name }}</p>
                    <p>{{ $order->customer_email }}</p>
                    <p>{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <p class="uppercase tracking-widest text-luxury-gold font-semibold mb-2">Delivery Destination</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_state }}</p>
                    <p>{{ $order->shipping_country }}</p>
                </div>
            </div>

            <!-- Purchased Items Table -->
            <div>
                <h3 class="uppercase tracking-widest text-xs text-luxury-gold font-semibold mb-4">Acquired Pieces</h3>
                <div class="divide-y divide-luxury-gold/10">
                    @foreach ($order->items as $item)
                        <div class="py-4 flex items-center justify-between text-xs">
                            <div>
                                <p class="text-luxury-cream font-medium text-sm">{{ $item->product_name }}</p>
                                <p class="text-luxury-cream/50 mt-1 font-mono">Qty: {{ $item->quantity }} &times; ₦{{ number_format($item->price, 2) }}</p>
                            </div>
                            <span class="font-mono text-luxury-gold font-semibold">₦{{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Financial Breakdown -->
            <div class="border-t border-luxury-gold/20 pt-6 space-y-3 text-xs">
                <div class="flex justify-between text-luxury-cream/70">
                    <span>Subtotal</span>
                    <span class="font-mono">₦{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-luxury-cream/70">
                    <span>Courier Delivery Fee</span>
                    <span class="font-mono">{{ $order->shipping_fee == 0 ? 'Free (Complimentary)' : '₦' . number_format($order->shipping_fee, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm font-semibold text-luxury-gold pt-3 border-t border-luxury-gold/10">
                    <span>Total Amount</span>
                    <span class="font-mono text-base">₦{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('dashboard') }}" 
               class="w-full sm:w-auto text-center bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-8 py-4 hover:bg-luxury-champagne transition duration-300">
                View Acquisition History
            </a>
            <a href="{{ Route::has('products.index') ? route('products.index') : url('/') }}" 
   class="w-full sm:w-auto text-center border border-luxury-gold/50 text-luxury-cream font-semibold text-xs uppercase tracking-widest px-8 py-4 hover:border-luxury-gold hover:text-luxury-gold transition duration-300">
    Return to Boutique
</a>
        </div>
    </div>
</x-app-layout>