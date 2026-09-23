<x-app-layout>
    <!-- Header Banner -->
    <div class="bg-luxury-black border-b border-luxury-charcoal py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Akaego Collections</span>
            <h1 class="font-serif text-4xl md:text-5xl text-luxury-cream font-normal mt-2">The Catalog</h1>
            <p class="text-luxury-cream/60 text-sm mt-3 max-w-lg mx-auto font-light">
                Explore our full line of luxury apparel, fine jewellery, handcrafted leather goods, and Swiss timepieces.
            </p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="py-12 bg-luxury-black min-h-screen">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <!-- Sidebar Filters -->
            <aside class="space-y-8 bg-luxury-charcoal/50 p-6 border border-luxury-gold/15 h-fit">
                <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                    <div>
                        <h3 class="font-serif text-luxury-cream text-lg border-b border-luxury-gold/20 pb-2 mb-4">Categories</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 text-xs text-luxury-cream/80 hover:text-luxury-gold cursor-pointer">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()" class="text-luxury-gold focus:ring-0 bg-luxury-black border-luxury-gold/30">
                                <span>All Categories</span>
                            </label>
                            @foreach($categories as $cat)
                                <label class="flex items-center gap-3 text-xs text-luxury-cream/80 hover:text-luxury-gold cursor-pointer">
                                    <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()" class="text-luxury-gold focus:ring-0 bg-luxury-black border-luxury-gold/30">
                                    <span>{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="font-serif text-luxury-cream text-lg border-b border-luxury-gold/20 pb-2 mb-4">Sort By</h3>
                        <select name="sort" onchange="this.form.submit()" class="w-full bg-luxury-black border border-luxury-gold/30 text-luxury-cream text-xs p-3 focus:border-luxury-gold focus:outline-none">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>

                    @if(request()->anyFilled(['category', 'sort', 'min_price', 'max_price']))
                        <a href="{{ route('products.index') }}" class="block text-center text-xs text-luxury-gold uppercase tracking-widest border border-luxury-gold/30 py-2 hover:bg-luxury-gold hover:text-luxury-black transition">
                            Reset Filters
                        </a>
                    @endif
                </form>
            </aside>

            <!-- Product Grid -->
            <main class="lg:col-span-3">
                @if($products->isEmpty())
                    <div class="text-center py-20 border border-luxury-gold/15 bg-luxury-charcoal/30">
                        <p class="font-serif text-xl text-luxury-cream">No luxury pieces match your selection.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 text-xs text-luxury-gold uppercase tracking-widest border-b border-luxury-gold">View All Products</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-luxury-charcoal border border-luxury-gold/15 group hover:border-luxury-gold/50 transition duration-300 flex flex-col justify-between">
                                <div class="relative">
                                    <div class="w-full h-72 bg-luxury-black border-b border-luxury-gold/10 overflow-hidden">
                                        @if($product->primaryImage)
                                            <img src="{{ $product->primaryImage->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                                        @endif
                                    </div>
                                    @if($product->compare_at_price)
                                        <span class="absolute top-3 right-3 bg-luxury-gold text-luxury-black text-[10px] font-bold uppercase tracking-widest px-2 py-1">Exclusive</span>
                                    @endif
                                </div>
                                <div class="p-5 space-y-2">
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

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
            </main>

        </div>
    </div>
</x-app-layout>