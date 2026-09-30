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

            <!-- Action Buttons: Profile & Log Out -->
            <div class="flex items-center gap-3">
                <a href="{{ route('profile.edit') }}" class="bg-luxury-gold text-luxury-black text-xs font-semibold uppercase tracking-widest px-6 py-3 hover:bg-luxury-champagne transition duration-300">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="border border-luxury-gold/40 text-luxury-gold hover:bg-luxury-gold hover:text-luxury-black text-xs font-semibold uppercase tracking-widest px-6 py-3 transition duration-300">
                        Log Out
                    </button>
                </form>
            </div>
        </div>

        <!-- Upper Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Account Summary Card -->
            <div class="bg-luxury-charcoal border border-luxury-gold/20 p-6 flex flex-col justify-between">
                <div>
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

                <div class="mt-6 pt-4 border-t border-luxury-gold/10">
                    <a href="{{ route('profile.edit') }}" class="text-xs text-luxury-gold hover:text-luxury-champagne uppercase tracking-widest font-semibold inline-flex items-center gap-1">
                        Manage Security & Settings &rarr;
                    </a>
                </div>
            </div>

            <!-- Boutique Quick Links Card -->
            <div class="md:col-span-2 bg-luxury-charcoal border border-luxury-gold/20 p-6 flex flex-col justify-between">
                <div>
                    <h2 class="font-serif text-lg text-luxury-gold tracking-wide mb-4">Boutique Navigation</h2>
                    <p class="text-xs text-luxury-cream/70 leading-relaxed mb-6">
                        Access your active acquisitions, manage private credentials, or explore haute apparel, bespoke handbags, and precision timepieces.
                    </p>
                </div>

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

        <!-- Order History & Paystack Status Section -->
        <div class="bg-luxury-charcoal border border-luxury-gold/30 p-8">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-luxury-gold/20">
                <div>
                    <h2 class="font-serif text-xl text-luxury-gold tracking-wide">Acquisition History</h2>
                    <p class="text-xs text-luxury-cream/60 mt-1 uppercase tracking-wider">Your personal order records and payment statuses</p>
                </div>
                <span class="font-mono text-xs text-luxury-gold bg-luxury-gold/10 border border-luxury-gold/30 px-3 py-1">
                    {{ $orders->count() }} {{ Str::plural('Order', $orders->count()) }}
                </span>
            </div>

            @if ($orders->isEmpty())
                <div class="text-center py-12 border border-dashed border-luxury-gold/20 bg-luxury-black/40">
                    <svg class="w-12 h-12 text-luxury-gold/40 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <p class="text-sm text-luxury-cream/70 font-light">You have no order history yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 text-xs text-luxury-gold uppercase tracking-widest hover:text-luxury-champagne underline">
                        Begin Exploring The Boutique &rarr;
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-luxury-gold/20 text-luxury-gold uppercase tracking-widest font-mono">
                                <th class="pb-3 px-4">Order Ref</th>
                                <th class="pb-3 px-4">Date</th>
                                <th class="pb-3 px-4">Items</th>
                                <th class="pb-3 px-4 text-right">Total</th>
                                <th class="pb-3 px-4 text-center">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-luxury-gold/10 text-luxury-cream/80">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-luxury-black/30 transition">
                                    <!-- Order Number -->
                                    <td class="py-4 px-4 font-mono text-luxury-gold font-semibold">
                                        #{{ $order->order_number ?? $order->id }}
                                    </td>

                                    <!-- Order Date -->
                                    <td class="py-4 px-4 text-luxury-cream/60">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>

                                    <!-- Items Summary -->
                                    <td class="py-4 px-4 max-w-xs truncate">
                                        @if ($order->items && $order->items->count())
                                            {{ $order->items->pluck('product.name')->filter()->join(', ') }}
                                        @else
                                            <span class="italic text-luxury-cream/40">N/A</span>
                                        @endif
                                    </td>

                                    <!-- Total Price -->
                                    <td class="py-4 px-4 text-right font-mono font-semibold text-luxury-cream">
                                        ₦{{ number_format($order->total_amount ?? $order->total, 2) }}
                                    </td>

                                    <!-- Payment Status Badge -->
                                    <td class="py-4 px-4 text-center">
                                        @php
                                            $status = strtolower($order->payment_status ?? 'pending');
                                        @endphp

                                        @if ($status === 'paid' || $status === 'successful' || $status === 'completed')
                                            <span class="inline-block bg-emerald-950/60 text-emerald-400 border border-emerald-500/40 px-2.5 py-1 text-[10px] font-mono uppercase tracking-widest">
                                                Paid via Paystack
                                            </span>
                                        @elseif ($status === 'failed' || $status === 'cancelled')
                                            <span class="inline-block bg-rose-950/60 text-rose-400 border border-rose-500/40 px-2.5 py-1 text-[10px] font-mono uppercase tracking-widest">
                                                Payment Failed
                                            </span>
                                        @else
                                            <span class="inline-block bg-amber-950/60 text-amber-300 border border-amber-500/40 px-2.5 py-1 text-[10px] font-mono uppercase tracking-widest">
                                                Pending Payment
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>