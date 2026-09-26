<x-app-layout title="Checkout | AKAEGO LUXURY & BOUTIQUE">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <h1 class="font-serif text-3xl tracking-widest text-luxury-gold uppercase mb-8">Secure Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            @csrf

            <!-- Client & Shipping Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Contact Info -->
                <div class="bg-luxury-charcoal/40 border border-luxury-gold/20 p-6 space-y-4">
                    <h2 class="font-serif text-lg text-luxury-gold tracking-widest uppercase">1. Client Contact</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Full Name
                                *</label>
                            <input type="text" name="customer_name"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}" required
                                class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            @error('customer_name')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Email
                                Address *</label>
                            <input type="email" name="customer_email"
                                value="{{ old('customer_email', auth()->user()->email ?? '') }}" required
                                class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            @error('customer_email')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Phone
                                Number</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"
                                class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-luxury-charcoal/40 border border-luxury-gold/20 p-6 space-y-4">
                    <h2 class="font-serif text-lg text-luxury-gold tracking-widest uppercase">2. Delivery Address</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Street
                                Address *</label>
                            <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required
                                class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            @error('shipping_address')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">City
                                    *</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                                    class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">State /
                                    Region</label>
                                <input type="text" name="shipping_state" value="{{ old('shipping_state') }}"
                                    class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Postal
                                    Code *</label>
                                <input type="text" name="shipping_postal_code"
                                    value="{{ old('shipping_postal_code') }}" required
                                    class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider text-luxury-cream/70 mb-1">Country
                                *</label>
                            <input type="text" name="shipping_country"
                                value="{{ old('shipping_country', 'United States') }}" required
                                class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-2 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold">
                        </div>
                    </div>
                </div>

                <!-- Payment Selection -->
                <div class="bg-luxury-charcoal/40 border border-luxury-gold/20 p-6 space-y-4">
                    <h2 class="font-serif text-lg text-luxury-gold tracking-widest uppercase">3. Payment Option</h2>

                    <div class="space-y-3">
                        <label
                            class="flex items-center space-x-3 p-3 bg-luxury-black border border-luxury-gold/20 cursor-pointer">
                            <input type="radio" name="payment_method" value="paystack" checked
                                class="text-luxury-gold focus:ring-0">
                            <span class="text-sm">Paystack (Debit/Credit Card, Bank Transfer, USSD)</span>
                        </label>

                        <label
                            class="flex items-center space-x-3 p-3 bg-luxury-black border border-luxury-gold/20 cursor-pointer">
                            <input type="radio" name="payment_method" value="cod"
                                class="text-luxury-gold focus:ring-0">
                            <span class="text-sm">Private Concierge / Bank Transfer on Delivery</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="bg-luxury-charcoal/60 border border-luxury-gold/30 p-6 h-fit space-y-6">
                <h2
                    class="font-serif text-xl text-luxury-gold tracking-widest uppercase border-b border-luxury-gold/20 pb-4">
                    Order Summary
                </h2>

                <div class="space-y-4 max-h-64 overflow-y-auto pr-2">
                    @foreach ($cart as $id => $item)
                        <div class="flex justify-between text-xs">
                            <div>
                                <p class="font-semibold text-luxury-cream">{{ $item['name'] }}</p>
                                <p class="text-luxury-cream/60">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <span
                                class="text-luxury-gold font-mono">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-luxury-gold/20 pt-4 space-y-2 text-sm">
                    <div class="flex justify-between text-luxury-cream/70">
                        <span>Subtotal</span>
                        <span class="font-mono">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-luxury-cream/70">
                        <span>Delivery</span>
                        <span class="font-mono">
                            {{ $shippingFee === 0.0 ? 'COMPLIMENTARY' : '$' . number_format($shippingFee, 2) }}
                        </span>
                    </div>
                    <div
                        class="border-t border-luxury-gold/20 pt-3 flex justify-between font-serif text-lg text-luxury-gold">
                        <span>Total</span>
                        <span class="font-mono">${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-luxury-gold text-luxury-black py-3 uppercase tracking-widest text-xs font-semibold hover:bg-luxury-champagne transition">
                    Place Order & Proceed
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
