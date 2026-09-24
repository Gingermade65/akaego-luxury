<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-luxury-black overflow-hidden py-24 md:py-32 border-b border-luxury-charcoal">
        <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">
                    Autumn / Winter Collection {{ date('Y') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-6xl text-luxury-cream font-normal leading-tight">
                    Elegance Reimagined <br>
                    <span class="italic font-light text-luxury-gold">Without Compromise.</span>
                </h1>
                <p class="text-luxury-cream/70 text-sm md:text-base leading-relaxed max-w-lg font-light">
                    Discover bespoke craftsmanship, limited-edition couture, and refined boutique essentials designed for those who appreciate understated opulence.
                </p>
                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-block bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-8 py-4 hover:bg-luxury-champagne transition duration-300">
                        Explore Collection
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-block border border-luxury-gold/40 text-luxury-cream font-light text-xs uppercase tracking-widest px-8 py-4 hover:border-luxury-gold hover:text-luxury-gold transition duration-300">
                        View Lookbook
                    </a>
                </div>
            </div>
            
            <div class="relative flex justify-center">
                <div class="w-full max-w-md h-[450px] bg-luxury-charcoal border border-luxury-gold/20 p-4 relative group">
                    <div class="w-full h-full bg-luxury-black border border-luxury-gold/10 flex flex-col items-center justify-center p-8 text-center">
                        <div class="w-16 h-16 rounded-full border border-luxury-gold/30 flex items-center justify-center mb-4">
                            <span class="font-serif text-luxury-gold text-2xl italic">A</span>
                        </div>
                        <p class="font-serif text-luxury-gold text-lg tracking-widest mb-2">AKAEGO BOUTIQUE</p>
                        <p class="text-xs text-luxury-cream/50 uppercase tracking-widest">Handcrafted Limited Releases</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curated Categories Section -->
    <section class="py-20 bg-luxury-black border-b border-luxury-charcoal">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto mb-16 space-y-3">
                <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Curated Categories</span>
                <h2 class="font-serif text-3xl md:text-4xl text-luxury-cream font-normal">Featured Collections</h2>
                <div class="w-12 h-[1px] bg-luxury-gold mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <div class="bg-luxury-charcoal border border-luxury-gold/20 p-8 group hover:border-luxury-gold transition duration-500 flex flex-col justify-between h-[340px] relative overflow-hidden">
                        <div class="space-y-3 relative z-10">
                            <span class="text-luxury-gold/70 text-[10px] uppercase tracking-[0.25em]">0{{ $loop->iteration }} / Collection</span>
                            <h3 class="font-serif text-2xl text-luxury-cream group-hover:text-luxury-gold transition">{{ $category->name }}</h3>
                            <p class="text-luxury-cream/60 text-xs leading-relaxed font-light">{{ $category->description }}</p>
                        </div>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="relative z-10 text-xs text-luxury-gold uppercase tracking-widest font-medium flex items-center gap-2 group-hover:translate-x-1 transition duration-300">
                            Discover Category &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Dynamic Featured Products Section -->
    <section class="py-20 bg-luxury-black border-b border-luxury-charcoal">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Bespoke Selection</span>
                    <h2 class="font-serif text-3xl md:text-4xl text-luxury-cream font-normal mt-2">Featured Products</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs text-luxury-gold uppercase tracking-widest border-b border-luxury-gold/40 hover:border-luxury-gold pb-1 self-start md:self-auto transition">
                    View Entire Boutique &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="bg-luxury-charcoal border border-luxury-gold/15 group hover:border-luxury-gold/50 transition duration-300 flex flex-col justify-between">
                        <div class="p-4 relative">
                            <div class="w-full h-64 bg-luxury-black border border-luxury-gold/10 overflow-hidden relative flex items-center justify-center">
                                @if($product->primaryImage)
                                    <img src="{{ $product->primaryImage->image_path }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                                @else
                                    <span class="font-serif text-luxury-gold/40 text-xl tracking-widest uppercase">{{ $product->category->name }}</span>
                                @endif
                            </div>
                            @if($product->compare_at_price)
                                <span class="absolute top-6 right-6 bg-luxury-gold text-luxury-black text-[10px] font-bold uppercase tracking-widest px-2 py-1">
                                    Exclusive
                                </span>
                            @endif
                        </div>
                        <div class="p-6 pt-2 space-y-2">
                            <span class="text-[10px] uppercase tracking-widest text-luxury-gold/70">{{ $product->category->name }}</span>
                            <h3 class="font-serif text-lg text-luxury-cream group-hover:text-luxury-gold transition line-clamp-1">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-xs text-luxury-cream/50 line-clamp-2 font-light">{{ $product->summary }}</p>
                            <div class="pt-3 flex items-center justify-between border-t border-luxury-gold/10">
                                <span class="font-serif text-luxury-gold text-base">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product->slug) }}" class="text-[10px] uppercase tracking-widest text-luxury-cream hover:text-luxury-gold transition">View Piece &rarr;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>