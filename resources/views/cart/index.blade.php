<x-app-layout>
    <div class="bg-luxury-black border-b border-luxury-charcoal py-8">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Client Bag</span>
            <h1 class="font-serif text-3xl sm:text-4xl text-luxury-cream font-normal mt-1">Your Selected Pieces</h1>
        </div>
    </div>

    <section class="py-12 bg-luxury-black min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-950/30 border border-emerald-500/40 text-emerald-300 text-xs tracking-wider uppercase">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    
                    <!-- Cart Items Table/List -->
                    <div class="lg:col-span-2 space-y-6">
                        @foreach($cart as $id => $item)
                            <div class="bg-luxury-charcoal border border-luxury-gold/15 p-6 flex flex-col sm:flex-row items-center justify-between gap-6">
                                <div class="flex items-center gap-6 w-full sm:w-auto">
                                    <div class="w-20 h-24 bg-luxury-black border border-luxury-gold/10 overflow-hidden flex-shrink-0">
                                        @if($item['image'])
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-luxury-gold/40 font-serif">AKAEGO</div>
                                        @endif
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[10px] uppercase tracking-widest text-luxury-gold/70">{{ $item['category'] }}</span>
                                        <h3 class="font-serif text-lg text-luxury-cream">
                                            <a href="{{ route('products.show', $item['slug']) }}" class="hover:text-luxury-gold transition">{{ $item['name'] }}</a>
                                        </h3>
                                        <p class="text-xs text-luxury-cream/50 uppercase tracking-wider">SKU: {{ $item['sku'] }}</p>
                                        <p class="font-serif text-luxury-gold text-sm pt-1">${{ number_format($item['price'], 2) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 border-luxury-gold/10 pt-4 sm:pt-0">
                                    <!-- Update Quantity Form -->
                                    <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="quantity" onchange="this.form.submit()" class="bg-luxury-black border border-luxury-gold/30 text-luxury-cream text-xs px-2 py-1 focus:border-luxury-gold focus:outline-none">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </form>

                                    <!-- Price Subtotal -->
                                    <span class="font-serif text-luxury-cream text-base">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>

                                    <!-- Remove Action -->
                                    <form method="POST" action="{{ route('cart.destroy', $id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-luxury-cream/40 hover:text-rose-400 text-xs transition uppercase tracking-widest">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <div class="pt-4 flex justify-between items-center text-xs">
                            <a href="{{ route('products.index') }}" class="text-luxury-gold uppercase tracking-widest border-b border-luxury-gold/40 hover:border-luxury-gold pb-1 transition">
                                &larr; Continue Exploring Collections
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary Box -->
                    <div class="bg-luxury-charcoal/50 border border-luxury-gold/20 p-8 space-y-6 self-start">
                        <h2 class="font-serif text-xl text-luxury-gold border-b border-luxury-gold/15 pb-4">Order Summary</h2>

                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between text-luxury-cream/70">
                                <span>Subtotal ({{ $itemCount }} {{ Str::plural('piece', $itemCount) }})</span>
                                <span class="font-serif text-luxury-cream">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-luxury-cream/70">
                                <span>Complimentary Worldwide Express</span>
                                <span class="text-emerald-400 uppercase tracking-wider">Free</span>
                            </div>
                            <div class="flex justify-between text-luxury-cream/70">
                                <span>Estimated Taxes & Duties</span>
                                <span class="text-luxury-cream/50 italic">Calculated at Checkout</span>
                            </div>
                        </div>

                        <div class="border-t border-luxury-gold/20 pt-4 flex justify-between items-baseline">
                            <span class="text-xs uppercase tracking-widest text-luxury-gold font-semibold">Total</span>
                            <span class="font-serif text-2xl text-luxury-gold">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <a href="#" class="block w-full bg-luxury-gold text-luxury-black text-xs uppercase tracking-widest font-semibold text-center py-4 hover:bg-luxury-champagne transition">
                            Proceed to Secure Checkout
                        </a>

                        <p class="text-[10px] text-luxury-cream/40 text-center leading-relaxed">
                            Encrypted 256-bit SSL transaction. Guaranteed authenticity and insured courier delivery.
                        </p>
                    </div>

                </div>
            @else
                <div class="p-16 text-center bg-luxury-charcoal/30 border border-luxury-gold/15 space-y-4 max-w-2xl mx-auto">
                    <p class="font-serif text-2xl text-luxury-gold">Your Shopping Bag is Currently Empty</p>
                    <p class="text-xs text-luxury-cream/60 leading-relaxed">
                        Curate your personal collection with our latest limited-edition releases, bespoke timepieces, and haute apparel.
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('products.index') }}" class="inline-block bg-luxury-gold text-luxury-black text-xs font-semibold uppercase tracking-widest px-8 py-4 hover:bg-luxury-champagne transition">
                            Explore Boutique Catalog
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>