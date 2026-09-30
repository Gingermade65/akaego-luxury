<x-app-layout>
    <x-slot name="title">Checkout | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="mb-10 text-center md:text-left border-b border-luxury-gold/20 pb-6">
            <span class="text-xs text-luxury-gold uppercase tracking-widest font-semibold">Private Client Acquisition</span>
            <h1 class="font-serif text-3xl text-luxury-cream mt-1">Order Checkout</h1>
            <p class="text-xs text-luxury-cream/60 mt-2 uppercase tracking-wider">Provide delivery details to finalize your purchase</p>
        </div>

        @if (session('error'))
            <div class="mb-8 p-4 bg-rose-950/60 border border-rose-500/40 text-rose-300 text-xs tracking-wider uppercase">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left: Delivery Details Form -->
            <div class="lg:col-span-7 bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl">
                <h2 class="font-serif text-xl text-luxury-gold tracking-wide mb-6">Delivery Address</h2>

                <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}" class="space-y-6">
                    @csrf

                    <!-- Payment Method (Paystack Default) -->
                    <input type="hidden" name="payment_method" value="paystack">

                    <!-- Recipient Name -->
                    <div>
                        <label for="customer_name" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Full Name</label>
                        <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('customer_name')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="customer_email" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Email Address</label>
                        <input id="customer_email" type="email" name="customer_email" value="{{ old('customer_email', Auth::user()->email ?? '') }}" required
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('customer_email')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="customer_phone" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Phone Number</label>
                        <input id="customer_phone" type="tel" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="+234..." required
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('customer_phone')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Street Address -->
                    <div>
                        <label for="shipping_address" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Shipping Address</label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" required
                                  class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition"
                                  placeholder="Street name, suite, or apartment">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- City -->
                        <div>
                            <label for="shipping_city" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">City</label>
                            <input id="shipping_city" type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                                   class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                            @error('shipping_city')
                                <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- State -->
                        <div>
                            <label for="shipping_state" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">State / Region</label>
                            <input id="shipping_state" type="text" name="shipping_state" value="{{ old('shipping_state') }}" required
                                   class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                            @error('shipping_state')
                                <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="shipping_country" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Country</label>
                            <input id="shipping_country" type="text" name="shipping_country" value="{{ old('shipping_country', 'Nigeria') }}" required
                                   class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                            @error('shipping_country')
                                <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Direct Paystack Action -->
                    <div class="pt-4 border-t border-luxury-gold/20">
                        <button type="submit" 
                                class="w-full bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest py-4 hover:bg-luxury-champagne transition duration-300">
                            Proceed to Secure Paystack Gateway
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right: Order Summary Sidebar -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl">
                    <h2 class="font-serif text-xl text-luxury-gold tracking-wide mb-6">Order Summary</h2>

                    <div class="divide-y divide-luxury-gold/10 max-h-80 overflow-y-auto pr-2 mb-6">
                        @foreach ($cartItems as $item)
                            @php
                                $name = $item['name'] ?? $item['product']->name ?? 'Boutique Item';
                                $price = $item['price'] ?? $item['product']->price ?? 0;
                                $quantity = $item['quantity'] ?? 1;
                            @endphp
                            <div class="py-3 flex items-center justify-between text-xs">
                                <div>
                                    <p class="text-luxury-cream font-medium">{{ $name }}</p>
                                    <p class="text-luxury-cream/50 mt-0.5 font-mono">Qty: {{ $quantity }}</p>
                                </div>
                                <span class="font-mono text-luxury-gold">₦{{ number_format($price * $quantity, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-luxury-gold/20 pt-4 space-y-3 text-xs">
                        <div class="flex justify-between text-luxury-cream/70">
                            <span>Subtotal</span>
                            <span class="font-mono">₦{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-luxury-cream/70">
                            <span>Complimentary Courier</span>
                            <span class="text-emerald-400 uppercase tracking-widest font-mono">
                                {{ $shippingFee == 0 ? 'Free' : '₦' . number_format($shippingFee, 2) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm font-semibold text-luxury-gold pt-3 border-t border-luxury-gold/10">
                            <span>Total Due</span>
                            <span class="font-mono text-base">₦{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-luxury-charcoal/50 border border-luxury-gold/20 p-6 text-center text-xs text-luxury-cream/60">
                    <p class="uppercase tracking-wider font-semibold text-luxury-gold mb-1">Encrypted Payment Guarantee</p>
                    <p>Transactions are routed securely through Paystack. Card details are never stored on boutique servers.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>