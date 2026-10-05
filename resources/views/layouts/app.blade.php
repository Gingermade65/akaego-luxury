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
    <div
        class="bg-luxury-charcoal border-b border-luxury-gold/20 text-luxury-gold text-xs tracking-widest text-center py-2 uppercase">
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

            <!-- Actions (Account, Admin Badge, Cart Counter & Mobile Hamburger) -->
            <div class="flex items-center space-x-5 text-sm">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.orders.index') }}"
                            class="hidden sm:inline-flex items-center gap-1 px-2.5 py-1 bg-amber-500/10 border border-amber-500/40 text-amber-300 hover:bg-amber-500/20 text-[10px] uppercase tracking-widest rounded transition">
                            Admin
                        </a>
                    @endif

                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}"
                            class="hover:text-luxury-gold transition flex items-center gap-1.5">
                            <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="hidden md:inline">Account</span>
                        </a>
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="hover:text-luxury-gold transition flex items-center gap-1.5">
                            <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1" />
                            </svg>
                            <span class="hidden md:inline">Sign In</span>
                        </a>
                    @endif
                @endauth

                <!-- Dynamic Cart Count Badge -->
                <a href="{{ route('cart.index') }}"
                    class="hover:text-luxury-gold transition flex items-center gap-1.5">
                    <span class="hidden md:inline">Cart</span>
                    <span
                        class="bg-luxury-gold text-luxury-black font-mono text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartService->getItemCount() }}
                    </span>
                </a>

                <!-- Mobile Hamburger Button -->
                <button type="button" onclick="toggleMobileMenu()"
                    class="md:hidden text-luxury-gold border border-luxury-gold/30 p-1.5 rounded focus:outline-none focus:border-luxury-gold"
                    aria-label="Toggle Navigation Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu Drawer -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-luxury-black/95 border-b border-luxury-gold/20 px-6 py-6 space-y-4">
            <nav class="flex flex-col space-y-4 text-xs font-semibold uppercase tracking-widest">
                <a href="{{ route('home') }}"
                    class="text-luxury-cream hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Home</a>
                <a href="{{ route('products.index') }}"
                    class="text-luxury-cream hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Boutique
                    Catalog</a>
                <a href="{{ route('products.index', ['category' => 'haute-apparel']) }}"
                    class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Apparel</a>
                <a href="{{ route('products.index', ['category' => 'bespoke-handbags']) }}"
                    class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Handbags</a>
                <a href="{{ route('products.index', ['category' => 'timepieces']) }}"
                    class="text-luxury-cream/80 hover:text-luxury-gold pb-2 border-b border-luxury-gold/10">Timepieces</a>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.orders.index') }}" class="text-amber-400 pt-2 font-bold">Concierge Admin
                            Portal</a>
                    @endif
                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}" class="text-luxury-gold pt-1">Client Dashboard</a>
                    @endif
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}" class="pt-1">
                            @csrf
                            <button type="submit"
                                class="text-xs uppercase tracking-widest text-rose-400 hover:text-rose-300">
                                Log Out
                            </button>
                        </form>
                    @endif
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-luxury-gold pt-2">Client Sign In</a>
                    @endif
                    <a href="{{ route('login', ['role' => 'admin']) }}"
                        class="text-amber-400/80 hover:text-amber-300 pt-1">
                        Admin Portal Login
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Page Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-950 border-t border-amber-500/20 text-neutral-400 text-xs py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Brand / Story -->
            <div>
                <h3 class="font-serif text-amber-200 text-sm tracking-widest uppercase mb-3">Akaego Luxury</h3>
                <p class="text-neutral-500 leading-relaxed">Curated haute couture, bespoke jewelry, and fine artisan
                    accessories.</p>
            </div>

            <!-- Navigation Links -->
            <div>
                <h4 class="font-serif text-amber-200 text-xs tracking-widest uppercase mb-3">Explore</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-300 transition">Boutique Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-amber-300 transition">Collections</a>
                    </li>
                    <li><a href="{{ route('cart.index') }}" class="hover:text-amber-300 transition">Cart</a></li>
                </ul>
            </div>

            <!-- Client Services -->
            <div>
                <h4 class="font-serif text-amber-200 text-xs tracking-widest uppercase mb-3">Client Care</h4>
                <ul class="space-y-2">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:text-amber-300 transition">My Account</a>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-amber-300 transition">Client Login</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Operations Section -->
            <div>
                <h4 class="font-serif text-amber-200 text-xs tracking-widest uppercase mb-3">Operations</h4>
                <ul class="space-y-2">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li>
                                <a href="{{ route('admin.orders.index') }}"
                                    class="inline-flex items-center gap-1.5 text-amber-400 hover:text-amber-200 font-semibold uppercase tracking-widest transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Concierge Admin Portal
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="text-neutral-600 uppercase tracking-widest text-[10px]">Standard Client
                                    Session</span>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{ route('login', ['role' => 'admin']) }}"
                                class="inline-flex items-center gap-1.5 text-amber-500/80 hover:text-amber-300 uppercase tracking-widest transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Admin Portal Access
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-6 border-t border-neutral-900 text-center text-[10px] text-neutral-600 uppercase tracking-widest">
            &copy; {{ date('Y') }} AKAEGO LUXURY. All Rights Reserved.
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
