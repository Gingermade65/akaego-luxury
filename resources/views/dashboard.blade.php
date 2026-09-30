<x-app-layout>
    <x-slot name="title">Client Dashboard | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header Banner -->
        <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8 mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <span class="text-xs text-luxury-gold uppercase tracking-widest font-semibold">Private Client Suite</span>
                <h1 class="font-serif text-2xl md:text-3xl text-luxury-cream mt-1">
                    Welcome back, {{ Auth::user()->name }}
                </h1>
            </div>

            <!-- Quick Action: Log Out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="border border-luxury-gold/40 text-luxury-gold hover:bg-luxury-gold hover:text-luxury-black text-xs font-semibold uppercase tracking-widest px-6 py-3 transition duration-300">
                    Log Out
                </button>
            </form>
        </div>

        <!-- Dashboard Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Profile Info Card -->
            <div class="bg-luxury-charcoal border border-luxury-gold/20 p-6">
                <h2 class="font-serif text-lg text-luxury-gold tracking-wide mb-4">Account Information</h2>
                <div class="space-y-3 text-xs text-luxury-cream/80">
                    <div>
                        <span class="text-luxury-cream/50 uppercase tracking-wider block">Full Name</span>
                        <p class="text-sm text-luxury-cream mt-0.5">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <span class="text-luxury-cream/50 uppercase tracking-wider block">Email Address</span>
                        <p class="text-sm text-luxury-cream mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <span class="text-luxury-cream/50 uppercase tracking-wider block">Membership Status</span>
                        <span class="inline-block mt-1 bg-luxury-gold/10 text-luxury-gold border border-luxury-gold/30 px-2.5 py-1 font-mono text-[10px] uppercase tracking-widest">
                            Verified Client
                        </span>
                    </div>
                </div>
            </div>

            <!-- Recent Orders / Collections Card -->
            <div class="md:col-span-2 bg-luxury-charcoal border border-luxury-gold/20 p-6">
                <h2 class="font-serif text-lg text-luxury-gold tracking-wide mb-4">Boutique Navigation</h2>
                <p class="text-xs text-luxury-cream/70 leading-relaxed mb-6">
                    Access your curated orders, manage account credentials, or explore the latest haute apparel and timepiece arrivals.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-6 py-3 hover:bg-luxury-champagne transition">
                        Explore Catalog
                    </a>
                    <a href="{{ route('cart.index') }}" class="border border-luxury-gold/40 text-luxury-cream text-xs uppercase tracking-widest px-6 py-3 hover:border-luxury-gold hover:text-luxury-gold transition">
                        View Shopping Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>