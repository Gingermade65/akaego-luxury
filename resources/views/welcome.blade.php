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
                    <a href="#" class="inline-block bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-8 py-4 hover:bg-luxury-champagne transition duration-300">
                        Explore Collection
                    </a>
                    <a href="#" class="inline-block border border-luxury-gold/40 text-luxury-cream font-light text-xs uppercase tracking-widest px-8 py-4 hover:border-luxury-gold hover:text-luxury-gold transition duration-300">
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
</x-app-layout>