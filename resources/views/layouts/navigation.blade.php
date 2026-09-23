<nav class="bg-luxury-black border-b border-luxury-charcoal sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="font-serif text-2xl text-luxury-cream tracking-widest uppercase">
                AKAEGO <span class="text-luxury-gold italic text-xl font-light">Boutique</span>
            </span>
        </a>

        <!-- Desktop Navigation Links -->
        <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('home') }}" 
               class="text-xs uppercase tracking-[0.2em] {{ request()->routeIs('home') ? 'text-luxury-gold font-semibold' : 'text-luxury-cream/80 hover:text-luxury-gold' }} transition">
                Home
            </a>
            <a href="{{ route('products.index') }}" 
               class="text-xs uppercase tracking-[0.2em] {{ request()->routeIs('products.index') ? 'text-luxury-gold font-semibold' : 'text-luxury-cream/80 hover:text-luxury-gold' }} transition">
                Boutique / Shop
            </a>
            <a href="{{ route('products.index', ['category' => 'haute-apparel']) }}" 
               class="text-xs uppercase tracking-[0.2em] text-luxury-cream/80 hover:text-luxury-gold transition">
                Apparel
            </a>
            <a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}" 
               class="text-xs uppercase tracking-[0.2em] text-luxury-cream/80 hover:text-luxury-gold transition">
                Handbags
            </a>
            <a href="{{ route('products.index', ['category' => 'timepieces']) }}" 
               class="text-xs uppercase tracking-[0.2em] text-luxury-cream/80 hover:text-luxury-gold transition">
                Timepieces
            </a>
        </div>

        <!-- Right Side Cart Indicator -->
        <div class="flex items-center gap-6">
            <a href="#" class="text-luxury-cream hover:text-luxury-gold transition flex items-center gap-2">
                <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="text-xs uppercase tracking-wider text-luxury-cream/80 hidden sm:inline">Bag (0)</span>
            </a>
        </div>
    </div>
</nav>