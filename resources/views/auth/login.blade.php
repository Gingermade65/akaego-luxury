<x-app-layout>
    <x-slot name="title">Sign In | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="min-h-[70vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-2xl text-luxury-gold tracking-widest uppercase">Client Access</h1>
                <p class="text-xs text-luxury-cream/60 mt-2 uppercase tracking-wider">Sign in to your private account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-xs font-semibold text-emerald-400 bg-emerald-950/50 border border-emerald-500/30 p-3 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('email')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs uppercase tracking-widest text-luxury-gold">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] uppercase tracking-widest text-luxury-cream/60 hover:text-luxury-gold transition">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('password')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" 
                           class="bg-luxury-black border-luxury-gold/40 text-luxury-gold focus:ring-0 rounded-none">
                    <label for="remember_me" class="ml-2 text-xs text-luxury-cream/70 uppercase tracking-wider">Remember Client Details</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest py-4 hover:bg-luxury-champagne transition duration-300">
                    Sign In
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 pt-6 border-t border-luxury-gold/10 text-center">
                <p class="text-xs text-luxury-cream/60">
                    Don't have a private account? 
                    <a href="{{ route('register') }}" class="text-luxury-gold hover:text-luxury-champagne uppercase tracking-wider font-semibold ml-1">
                        Request Membership
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>