<x-app-layout>
    <!-- Breadcrumbs -->
    <div class="bg-luxury-black border-b border-luxury-charcoal py-4">
        <div class="max-w-7xl mx-auto px-6 text-xs text-luxury-cream/60 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-luxury-gold transition">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-luxury-gold transition">Boutique</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-luxury-gold transition">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-luxury-gold font-light truncate max-w-[200px] sm:max-w-none">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Main Product Section -->
    <section class="py-16 bg-luxury-black min-h-screen">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            
            <!-- Product Gallery (Alpine JS powered) -->
            <div x-data="{ activeImage: '{{ $product->primaryImage ? $product->primaryImage->image_path : '' }}' }" class="space-y-4">
                <!-- Main Featured Image Container -->
                <div class="w-full h-[480px] sm:h-[580px] bg-luxury-charcoal border border-luxury-gold/20 overflow-hidden relative group">
                    <template x-if="activeImage">
                        <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                    </template>
                    <template x-if="!activeImage">
                        <div class="w-full h-full flex items-center justify-center text-luxury-gold/30 font-serif">
                            No Visual Available
                        </div>
                    </template>
                    @if($product->compare_at_price)
                        <span class="absolute top-4 right-4 bg-luxury-gold text-luxury-black text-[10px] font-bold uppercase tracking-widest px-3 py-1">
                            Bespoke
                        </span>
                    @endif
                </div>

                <!-- Thumbnail Selector Grid -->
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $img)
                            <button @click="activeImage = '{{ $img->image_path }}'" 
                                    :class="activeImage === '{{ $img->image_path }}' ? 'border-luxury-gold' : 'border-luxury-gold/20 opacity-60 hover:opacity-100'"
                                    class="h-24 bg-luxury-charcoal border overflow-hidden transition duration-300 focus:outline-none">
                                <img src="{{ $img->image_path }}" alt="Product thumbnail" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Specs & Purchase Column -->
            <div class="space-y-8 flex flex-col justify-between">
                <div class="space-y-6">
                    <div>
                        <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">
                            {{ $product->category->name }}
                        </span>
                        <h1 class="font-serif text-3xl sm:text-4xl text-luxury-cream font-normal mt-2 leading-tight">
                            {{ $product->name }}
                        </h1>
                        <p class="text-xs text-luxury-cream/50 mt-1 uppercase tracking-widest">
                            SKU: <span class="text-luxury-cream/80 font-mono">{{ $product->sku }}</span>
                        </p>
                    </div>

                    <!-- Pricing & Stock Status -->
                    <div class="flex items-baseline gap-4 border-y border-luxury-gold/15 py-4">
                        <span class="font-serif text-3xl text-luxury-gold">${{ number_format($product->price, 2) }}</span>
                        @if($product->compare_at_price)
                            <span class="text-sm text-luxury-cream/40 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                        @endif
                        <span class="ml-auto text-xs uppercase tracking-widest px-3 py-1 {{ $product->quantity > 0 ? 'text-emerald-400 border border-emerald-500/30 bg-emerald-950/20' : 'text-rose-400 border border-rose-500/30' }}">
                            {{ $product->quantity > 0 ? 'In Stock (' . $product->quantity . ' available)' : 'Out of Stock' }}
                        </span>
                    </div>

                    <!-- Summary -->
                    <p class="text-luxury-cream/70 text-sm leading-relaxed font-light">
                        {{ $product->summary }}
                    </p>

                    <!-- Add to Bag Form -->
                    <form method="POST" action="#" class="space-y-6 pt-4">
                        @csrf
                        <div class="flex items-center gap-4">
                            <label for="quantity" class="text-xs uppercase tracking-widest text-luxury-cream/80">Quantity:</label>
                            <select id="quantity" name="quantity" class="bg-luxury-black border border-luxury-gold/30 text-luxury-cream text-xs px-4 py-3 focus:border-luxury-gold focus:outline-none">
                                @for($i = 1; $i <= min(10, max(1, $product->quantity)); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="button" 
                                    class="flex-1 bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-8 py-4 hover:bg-luxury-champagne transition duration-300 text-center">
                                Add To Shopping Bag
                            </button>
                            <a href="#" class="border border-luxury-gold/40 text-luxury-cream font-light text-xs uppercase tracking-widest px-6 py-4 hover:border-luxury-gold hover:text-luxury-gold transition duration-300 text-center">
                                Inquiry / Concierge
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Product Specifications Tabs -->
                <div x-data="{ tab: 'description' }" class="border-t border-luxury-gold/15 pt-6 space-y-4">
                    <div class="flex border-b border-luxury-gold/15 gap-6 text-xs uppercase tracking-widest">
                        <button @click="tab = 'description'" :class="tab === 'description' ? 'text-luxury-gold border-b-2 border-luxury-gold pb-2' : 'text-luxury-cream/60 hover:text-luxury-cream pb-2'">
                            Details
                        </button>
                        <button @click="tab = 'materials'" :class="tab === 'materials' ? 'text-luxury-gold border-b-2 border-luxury-gold pb-2' : 'text-luxury-cream/60 hover:text-luxury-cream pb-2'">
                            Craftsmanship
                        </button>
                        <button @click="tab = 'shipping'" :class="tab === 'shipping' ? 'text-luxury-gold border-b-2 border-luxury-gold pb-2' : 'text-luxury-cream/60 hover:text-luxury-cream pb-2'">
                            Complimentary Shipping
                        </button>
                    </div>

                    <div x-show="tab === 'description'" class="text-xs text-luxury-cream/70 leading-relaxed font-light space-y-2">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div x-show="tab === 'materials'" x-cloak class="text-xs text-luxury-cream/70 leading-relaxed font-light space-y-2">
                        <p>Hand-inspected materials adhering to sustainable luxury standards. Every piece undergoes rigorous quality control before dispatch.</p>
                    </div>
                    <div x-show="tab === 'shipping'" x-cloak class="text-xs text-luxury-cream/70 leading-relaxed font-light space-y-2">
                        <p>Includes signature packaging, certificate of authenticity, and tracked global shipping via DHL Express.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Related Products Showcase -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-16 bg-luxury-black border-t border-luxury-charcoal">
            <div class="max-w-7xl mx-auto px-6">
                <div class="mb-10 text-center">
                    <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.3em]">Complementary Pieces</span>
                    <h2 class="font-serif text-2xl md:text-3xl text-luxury-cream font-normal mt-2">You May Also Appreciate</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    @foreach($relatedProducts as $rel)
                        <div class="bg-luxury-charcoal border border-luxury-gold/15 group hover:border-luxury-gold/50 transition duration-300 flex flex-col justify-between">
                            <div class="w-full h-64 bg-luxury-black border-b border-luxury-gold/10 overflow-hidden relative">
                                @if($rel->primaryImage)
                                    <img src="{{ $rel->image_path }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                                @endif
                            </div>
                            <div class="p-5 space-y-2">
                                <h3 class="font-serif text-base text-luxury-cream group-hover:text-luxury-gold transition line-clamp-1">
                                    <a href="{{ route('products.show', $rel->slug) }}">{{ $rel->name }}</a>
                                </h3>
                                <div class="pt-2 flex items-center justify-between border-t border-luxury-gold/10">
                                    <span class="font-serif text-luxury-gold text-sm">${{ number_format($rel->price, 2) }}</span>
                                    <a href="{{ route('products.show', $rel->slug) }}" class="text-[10px] uppercase tracking-widest text-luxury-cream hover:text-luxury-gold transition">View &rarr;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-app-layout>