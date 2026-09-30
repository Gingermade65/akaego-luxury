<x-app-layout>
    <x-slot name="title">Register | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="min-h-[75vh] flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-2xl text-luxury-gold tracking-widest uppercase">Client Membership</h1>
                <p class="text-xs text-luxury-cream/60 mt-2 uppercase tracking-wider">Create your private boutique account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('name')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('email')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('password')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                    @error('password_confirmation')
                        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest py-4 hover:bg-luxury-champagne transition duration-300">
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 pt-6 border-t border-luxury-gold/10 text-center">
                <p class="text-xs text-luxury-cream/60">
                    Already a private client? 
                    <a href="{{ route('login') }}" class="text-luxury-gold hover:text-luxury-champagne uppercase tracking-wider font-semibold ml-1">
                        Sign In
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>