@inject('cartService', 'App\Services\CartService')

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
        Complimentary Delivery Across Nigeria on Orders Over ₦500,000
    </div>

    <!-- Main Navigation Bar -->
    <header class="border-b border-luxury-charcoal sticky top-0 bg-luxury-black/90 backdrop-blur-md z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}"
               class="font-serif text-2xl tracking-widest font-bold text-luxury-gold hover:text-luxury-champagne transition">
                AKAEGO
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-wider font-light">
                <a href="{{ route('home') }}"
                   class="hover:text-luxury-gold transition {{ request()->routeIs('home') ? 'text-luxury-gold font-normal' : 'text-luxury-cream/80' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}"
                   class="hover:text-luxury-gold transition {{ request()->routeIs('products.index') ? 'text-luxury-gold font-normal' : 'text-luxury-cream/80' }}">
                    Boutique Catalog
                </a>
                <a href="{{ route('products.index', ['category' => 'haute-apparel']) }}"
                   class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Apparel
                </a>
                <a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}"
                   class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Handbags
                </a>
                <a href="{{ route('products.index', ['category' => 'timepieces']) }}"
                   class="hover:text-luxury-gold transition text-luxury-cream/80">
                    Timepieces
                </a>
            </nav>

            <!-- Actions (Account, Cart Counter & Mobile Hamburger) -->
            <div class="flex items-center space-x-5 text-sm">
                <!-- Account / Sign In Icon Link -->
                @auth
                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}" class="hover:text-luxury-gold transition flex items-center gap-1.5">
                            <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="hidden md:inline">Account</span>
                        </a>
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="hover:text-luxury-gold transition flex items-center gap-1.5">
                            <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden md:inline">Sign In</span>
                        </a>
                    @endif
                @endauth

                <!-- Dynamic Cart Count Badge -->
                <a href="{{ route('cart.index') }}" class="hover:text-luxury-gold transition flex items-center gap-1.5">
                    <span class="hidden md:inline">Cart</span>
                    <span class="bg-luxury-gold text-luxury-black font-mono text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartService->getItemCount() }}
                    </span>
                </a>

                <!-- Mobile Hamburger Button -->
                <button type="button" 
                        onclick="toggleMobileMenu()" 
                        class="md:hidden text-luxury-gold border border-luxury-gold/30 p-1.5 rounded focus:outline-none focus:border-luxury-gold"
                        aria-label="Toggle Navigation Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu Drawer -->
        <div id="mobile-menu" class="hidden md:hidden bg-luxury-black/95 border-b border-luxury-gold/20 px-6 py-6 space-y-4">
            <nav class="flex flex-col space-y-4 text-xs font-semibold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="text-luxury-cream hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Home</a>
                <a href="{{ route('products.index') }}" class="text-luxury-cream hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Boutique Catalog</a>
                <a href="{{ route('products.index', ['category' => 'haute-apparel']) }}" class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Apparel</a>
                <a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}" class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Handbags</a>
                <a href="{{ route('products.index', ['category' => 'timepieces']) }}" class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Timepieces</a>

                @auth
                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}" class="text-luxury-gold pt-2">Client Dashboard</a>
                    @endif
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}" class="pt-1">
                            @csrf
                            <button type="submit" class="text-xs uppercase tracking-widest text-rose-400 hover:text-rose-300">
                                Log Out
                            </button>
                        </form>
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-luxury-gold pt-2">Client Sign In</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-luxury-cream/70">Create Account</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Page Content Slot -->
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

    <!-- Mobile Drawer Toggle Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
    </script>
</body>
</html>