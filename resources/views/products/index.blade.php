<x-app-layout>
    <div class="bg-luxury-black border-b border-luxury-charcoal py-8">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Curated Catalog</span>
            <h1 class="font-serif text-3xl sm:text-4xl text-luxury-cream font-normal mt-1">Boutique Collection</h1>
        </div>
    </div>

    <section class="py-12 bg-luxury-black min-h-screen">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Filters Form -->
            <aside class="space-y-8 bg-luxury-charcoal/40 p-6 border border-luxury-gold/15 self-start">
                <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <!-- Search Input -->
                    <div>
                        <label for="search" class="text-xs uppercase tracking-widest text-luxury-gold block mb-2 font-medium">Search</label>
                        <input type="text" 
                               id="search"
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Keywords, SKU..." 
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-3 py-2 text-xs text-luxury-cream focus:outline-none focus:border-luxury-gold placeholder:text-luxury-cream/30">
                    </div>

                    <!-- Categories Filter -->
                    <div>
                        <h3 class="text-xs uppercase tracking-widest text-luxury-gold mb-3 font-medium">Collections</h3>
                        <ul class="space-y-2 text-xs">
                            <li>
                                <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}" 
                                   class="{{ !request('category') ? 'text-luxury-gold font-bold' : 'text-luxury-cream/70 hover:text-luxury-cream' }}">
                                    All Collections
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" 
                                       class="{{ request('category') == $cat->slug ? 'text-luxury-gold font-bold' : 'text-luxury-cream/70 hover:text-luxury-cream' }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Range Filter -->
                    <div>
                        <h3 class="text-xs uppercase tracking-widest text-luxury-gold mb-3 font-medium">Price Range</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" 
                                   name="min_price" 
                                   value="{{ request('min_price') }}" 
                                   placeholder="Min $" 
                                   class="bg-luxury-black border border-luxury-gold/30 px-2 py-2 text-xs text-luxury-cream focus:outline-none focus:border-luxury-gold">
                            <input type="number" 
                                   name="max_price" 
                                   value="{{ request('max_price') }}" 
                                   placeholder="Max $" 
                                   class="bg-luxury-black border border-luxury-gold/30 px-2 py-2 text-xs text-luxury-cream focus:outline-none focus:border-luxury-gold">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-2 flex flex-col gap-2">
                        <button type="submit" class="w-full bg-luxury-gold text-luxury-black text-xs uppercase tracking-widest font-semibold py-3 hover:bg-luxury-champagne transition">
                            Apply Filters
                        </button>
                        @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'sort']))
                            <a href="{{ route('products.index') }}" class="w-full text-center text-[10px] uppercase tracking-widest text-luxury-cream/60 hover:text-luxury-gold py-2 transition">
                                Clear All Filters
                            </a>
                        @endif
                    </div>
                </form>
            </aside>

            <!-- Product Grid Column -->
            <main class="lg:col-span-3 space-y-6">
                <!-- Top Toolbar: Results Count & Sort Dropdown -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-luxury-gold/15 pb-4 gap-4 text-xs">
                    <span class="text-luxury-cream/60">
                        Showing <strong class="text-luxury-gold">{{ $products->firstItem() ?? 0 }}</strong> - <strong class="text-luxury-gold">{{ $products->lastItem() ?? 0 }}</strong> of <strong class="text-luxury-gold">{{ $products->total() }}</strong> results
                    </span>

                    <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                        @foreach(request()->except('sort', 'page') as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <label for="sort" class="text-luxury-cream/60 uppercase tracking-wider">Sort By:</label>
                        <select id="sort" name="sort" onchange="this.form.submit()" class="bg-luxury-black border border-luxury-gold/30 text-luxury-cream text-xs px-3 py-1.5 focus:outline-none focus:border-luxury-gold">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </form>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-luxury-charcoal border border-luxury-gold/15 group hover:border-luxury-gold/50 transition duration-300 flex flex-col justify-between">
                                <div class="p-4 relative">
                                    <div class="w-full h-60 bg-luxury-black border border-luxury-gold/10 overflow-hidden relative flex items-center justify-center">
                                        @if($product->primaryImage)
                                            <img src="{{ $product->primaryImage->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                                        @else
                                            <span class="font-serif text-luxury-gold/40 text-lg tracking-widest uppercase">{{ $product->category->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5 pt-0 space-y-2">
                                    <span class="text-[10px] uppercase tracking-widest text-luxury-gold/70">{{ $product->category->name }}</span>
                                    <h2 class="font-serif text-base text-luxury-cream group-hover:text-luxury-gold transition line-clamp-1">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h2>
                                    <p class="text-xs text-luxury-cream/50 line-clamp-2 font-light">{{ $product->summary }}</p>
                                    <div class="pt-3 flex items-center justify-between border-t border-luxury-gold/10">
                                        <span class="font-serif text-luxury-gold text-sm">${{ number_format($product->price, 2) }}</span>
                                        <a href="{{ route('products.show', $product->slug) }}" class="text-[10px] uppercase tracking-widest text-luxury-cream hover:text-luxury-gold transition">View &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Links -->
                    <div class="pt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="p-12 text-center bg-luxury-charcoal/30 border border-luxury-gold/15 space-y-3">
                        <p class="font-serif text-xl text-luxury-gold">No Pieces Match Your Criteria</p>
                        <p class="text-xs text-luxury-cream/60">Try adjusting your keyword query, removing price bounds, or exploring another collection.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-luxury-gold text-luxury-black text-xs font-semibold uppercase tracking-widest px-6 py-3 hover:bg-luxury-champagne transition">
                            Reset Search
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </section>
</x-app-layout>