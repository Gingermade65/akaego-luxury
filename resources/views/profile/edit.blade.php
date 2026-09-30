<x-app-layout>
    <x-slot name="title">Account Settings | AKAEGO LUXURY & BOUTIQUE</x-slot>

    <div class="max-w-5xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="mb-10 text-center md:text-left border-b border-luxury-gold/20 pb-6">
            <span class="text-xs text-luxury-gold uppercase tracking-widest font-semibold">Private Client Suite</span>
            <h1 class="font-serif text-3xl text-luxury-cream mt-1">Profile & Security Settings</h1>
            <p class="text-xs text-luxury-cream/60 mt-2 uppercase tracking-wider">Manage your credentials and personal details</p>
        </div>

        <div class="space-y-10">
            <!-- Profile Information Section -->
            <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-xl">
                <div class="mb-6">
                    <h2 class="font-serif text-xl text-luxury-gold tracking-wide">Personal Details</h2>
                    <p class="text-xs text-luxury-cream/60 mt-1">Update your name and account email address.</p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Full Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('name')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Email Address</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('email')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" 
                                class="bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-6 py-3.5 hover:bg-luxury-champagne transition duration-300">
                            Save Changes
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-xs text-emerald-400 font-mono">Saved successfully.</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Password Update Section -->
            <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8 shadow-xl">
                <div class="mb-6">
                    <h2 class="font-serif text-xl text-luxury-gold tracking-wide">Security & Password</h2>
                    <p class="text-xs text-luxury-cream/60 mt-1">Ensure your account uses a long, random password to remain secure.</p>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('put')

                    <!-- Current Password -->
                    <div>
                        <label for="update_password_current_password" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Current Password</label>
                        <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('current_password', 'updatePassword')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="update_password_password" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">New Password</label>
                        <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('password', 'updatePassword')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="update_password_password_confirmation" class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Confirm New Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                               class="w-full bg-luxury-black border border-luxury-gold/30 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-luxury-gold transition">
                        @error('password_confirmation', 'updatePassword')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" 
                                class="bg-luxury-gold text-luxury-black font-semibold text-xs uppercase tracking-widest px-6 py-3.5 hover:bg-luxury-champagne transition duration-300">
                            Update Password
                        </button>

                        @if (session('status') === 'password-updated')
                            <p class="text-xs text-emerald-400 font-mono">Password updated.</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-luxury-charcoal border border-rose-950/60 p-8 shadow-xl">
                <div class="mb-6">
                    <h2 class="font-serif text-xl text-rose-400 tracking-wide">Delete Account</h2>
                    <p class="text-xs text-luxury-cream/60 mt-1">Once your account is deleted, all resources and data will be permanently removed.</p>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6 max-w-xl" onsubmit="return confirm('Are you sure you want to permanently delete your account?');">
                    @csrf
                    @method('delete')

                    <div>
                        <label for="delete_account_password" class="block text-xs uppercase tracking-widest text-rose-400 mb-2">Confirm Password to Delete</label>
                        <input id="delete_account_password" name="password" type="password" placeholder="Enter password to confirm"
                               class="w-full bg-luxury-black border border-rose-900/50 px-4 py-3 text-sm text-luxury-cream focus:outline-none focus:border-rose-500 transition">
                        @error('password', 'userDeletion')
                            <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="border border-rose-500/50 text-rose-400 hover:bg-rose-600 hover:text-white text-xs font-semibold uppercase tracking-widest px-6 py-3.5 transition duration-300">
                        Delete Private Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>