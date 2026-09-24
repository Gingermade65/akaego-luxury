<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'AKAEGO LUXURY & BOUTIQUE' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-luxury-black text-luxury-cream antialiased min-h-screen flex flex-col justify-between">
    <!-- Top Announcement Bar -->
    <div class="bg-luxury-charcoal border-b border-luxury-gold/20 text-luxury-gold text-xs tracking-widest text-center py-2 uppercase">
        Complimentary Worldwide Shipping on Orders Over $500
    </div>

    <!-- Main Navigation Bar -->
    <header class="border-b border-luxury-charcoal sticky top-0 bg-luxury-black/90 backdrop-blur-md z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-serif text-2xl tracking-widest font-bold text-luxury-gold hover:text-luxury-champagne transition">
                AKAEGO
            </a>
            
            <nav class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-wider font-light">
                <a href="{{ route('home') }}" class="hover:text-luxury-gold transition {{ request()->routeIs('home') ? 'text-luxury-gold font-normal' : 'text-luxury-cream/80' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="hover:text-luxury-gold transition {{ request()->routeIs('products.index') ? 'text-luxury-gold font-normal' : 'text-luxury-cream/80' }}">
                    Boutique / Shop
                </a>
                <a href="{{ route('products.index', ['category' => 'haute-apparel']) }}" class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Apparel
                </a>
                <a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}" class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Handbags
                </a>
                <a href="{{ route('products.index', ['category' => 'timepieces']) }}" class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Timepieces
                </a>
            </nav>

            <div class="flex items-center space-x-6 text-sm">
                <a href="#" class="hover:text-luxury-gold transition">Account</a>
                <a href="#" class="hover:text-luxury-gold transition">Cart (0)</a>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-luxury-charcoal border-t border-luxury-gold/10 py-12 text-sm">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-serif text-lg text-luxury-gold mb-4 tracking-widest">AKAEGO</h3>
                <p class="text-luxury-cream/60 text-xs leading-relaxed">
                    Elevated luxury fashion and boutique essentials curated for timeless elegance.
                </p>
            </div>
            <div>
                <h4 class="text-xs font-semibold tracking-widest uppercase mb-4 text-luxury-gold">Explore</h4>
                <ul class="space-y-2 text-xs text-luxury-cream/70">
                    <li><a href="{{ route('products.index') }}" class="hover:text-luxury-cream">All Products</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'haute-apparel']) }}" class="hover:text-luxury-cream">Haute Apparel</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}" class="hover:text-luxury-cream">Handbags</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-semibold tracking-widest uppercase mb-4 text-luxury-gold">Client Care</h4>
                <ul class="space-y-2 text-xs text-luxury-cream/70">
                    <li><a href="#" class="hover:text-luxury-cream">Contact Us</a></li>
                    <li><a href="#" class="hover:text-luxury-cream">Shipping & Returns</a></li>
                    <li><a href="#" class="hover:text-luxury-cream">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-semibold tracking-widest uppercase mb-4 text-luxury-gold">Newsletter</h4>
                <p class="text-xs text-luxury-cream/60 mb-3">Join the inner circle for private collection launches.</p>
                <div class="flex">
                    <input type="email" placeholder="Enter your email" class="bg-luxury-black border border-luxury-gold/30 px-3 py-2 text-xs text-luxury-cream focus:outline-none focus:border-luxury-gold flex-grow">
                    <button class="bg-luxury-gold text-luxury-black px-4 py-2 text-xs uppercase tracking-wider hover:bg-luxury-champagne transition font-semibold">Join</button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-12 pt-6 border-t border-luxury-black/50 text-center text-xs text-luxury-cream/40">
            &copy; {{ date('Y') }} AKAEGO LUXURY & BOUTIQUE. All rights reserved.
        </div>
    </footer>
</body>
</html>