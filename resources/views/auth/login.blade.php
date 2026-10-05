<x-app-layout>
    <x-slot name="title">Sign In | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="min-h-[70vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl">
            <!-- Header -->
            <div class="mb-6 text-center">
                @if (request('role') === 'admin')
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 bg-amber-500/10 border border-amber-500/30 rounded-full text-amber-300 text-[10px] uppercase tracking-widest mb-3">
                        <svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Concierge Management
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-luxury-gold uppercase tracking-widest">
                        Admin Portal Access
                    </h2>
                    <p class="text-neutral-400 text-xs mt-1">
                        Enter administrative credentials to manage store operations and orders.
                    </p>
                @else
                    <h2 class="font-serif text-2xl font-bold text-luxury-gold uppercase tracking-widest">
                        Client Login
                    </h2>
                    <p class="text-neutral-400 text-xs mt-1">
                        Access your curated luxury orders, wishlists, and account preferences.
                    </p>
                @endif
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div
                    class="mb-4 text-xs font-semibold text-emerald-400 bg-emerald-950/50 border border-emerald-500/30 p-3 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login', request()->only('role')) }}">
    @csrf

    <!-- Explicit login type indicator -->
    <input type="hidden" name="login_type" value="{{ request('role') === 'admin' ? 'admin' : 'client' }}">

    <!-- Email Field -->
    <div class="mb-4">
        <label for="email" class="block text-xs uppercase tracking-widest text-luxury-gold mb-1">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-neutral-900 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2">
        @error('email')
            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="mb-4">
        <label for="password" class="block text-xs uppercase tracking-widest text-luxury-gold mb-1">Password</label>
        <input id="password" type="password" name="password" required class="w-full bg-neutral-900 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2">
        @error('password')
            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-black font-semibold uppercase tracking-widest text-xs py-3 rounded transition">
            {{ request('role') === 'admin' ? 'Authenticate Admin Access' : 'Sign In to Client Account' }}
        </button>
    </div>
</form>

            <!-- Register Link -->
            <div class="mt-8 pt-6 border-t border-luxury-gold/10 text-center">
                <p class="text-xs text-luxury-cream/60">
                    Don't have a private account?
                    <a href="{{ route('register') }}"
                        class="text-luxury-gold hover:text-luxury-champagne uppercase tracking-wider font-semibold ml-1">
                        Request Membership
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
