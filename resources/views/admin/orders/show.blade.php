@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' | Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <a href="{{ route('admin.orders.index') }}" class="text-xs uppercase tracking-widest text-neutral-400 hover:text-amber-300 flex items-center gap-1">
            ← Back to Orders
        </a>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-4 border-b border-amber-500/20 pb-6">
            <div>
                <h1 class="text-3xl font-serif text-amber-200 uppercase tracking-widest">Order #{{ $order->order_number }}</h1>
                <p class="text-xs text-neutral-400 uppercase tracking-widest mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-950/60 border border-emerald-500/30 text-emerald-300 text-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Items & Totals -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-neutral-900/60 border border-neutral-800 rounded p-6">
                <h2 class="text-sm font-serif text-amber-200 uppercase tracking-wider border-b border-neutral-800 pb-3 mb-4">Acquisitions</h2>
                
                <div class="divide-y divide-neutral-800">
                    @foreach($order->items as $item)
                        <div class="py-4 flex justify-between items-center">
                            <div>
                                <h3 class="font-medium text-white">{{ $item->product_name }}</h3>
                                <p class="text-xs text-neutral-400">Qty: {{ $item->quantity }} × ₦{{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="font-semibold text-amber-200">
                                ₦{{ number_format($item->total, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-neutral-800 pt-4 mt-4 space-y-2 text-sm text-neutral-300">
                    <div class="flex justify-between">
                        <span class="text-neutral-400">Subtotal</span>
                        <span>₦{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-neutral-400">Shipping Fee</span>
                        <span>{{ $order->shipping_fee > 0 ? '₦' . number_format($order->shipping_fee, 2) : 'Complimentary' }}</span>
                    </div>
                    <div class="flex justify-between font-serif text-lg text-amber-200 pt-2 border-t border-neutral-800">
                        <span>Total</span>
                        <span>₦{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Client & Delivery Address -->
            <div class="bg-neutral-900/60 border border-neutral-800 rounded p-6">
                <h2 class="text-sm font-serif text-amber-200 uppercase tracking-wider border-b border-neutral-800 pb-3 mb-4">Client Delivery Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-neutral-300">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-neutral-500 mb-1">Customer</p>
                        <p class="font-medium text-white">{{ $order->customer_name }}</p>
                        <p class="text-xs text-neutral-400">{{ $order->customer_email }}</p>
                        <p class="text-xs text-neutral-400">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-neutral-500 mb-1">Shipping Address</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}</p>
                        <p class="text-xs text-neutral-400">{{ $order->shipping_country }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Controls Sidebar -->
        <div class="space-y-6">
            <div class="bg-neutral-900/60 border border-amber-500/20 rounded p-6">
                <h2 class="text-sm font-serif text-amber-200 uppercase tracking-wider border-b border-neutral-800 pb-3 mb-4">Status & Control</h2>

                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-neutral-400 mb-2">Fulfillment Status</label>
                        <select name="status" class="w-full bg-neutral-950 border border-neutral-800 rounded px-3 py-2 text-sm text-white focus:border-amber-500 focus:outline-none">
                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $st)
                                <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-neutral-400 mb-2">Payment Status</label>
                        <select name="payment_status" class="w-full bg-neutral-950 border border-neutral-800 rounded px-3 py-2 text-sm text-white focus:border-amber-500 focus:outline-none">
                            @foreach(['unpaid', 'paid', 'refunded'] as $pst)
                                <option value="{{ $pst }}" {{ $order->payment_status === $pst ? 'selected' : '' }}>
                                    {{ ucfirst($pst) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full mt-4 bg-amber-500 hover:bg-amber-400 text-neutral-950 font-semibold py-2.5 px-4 text-xs uppercase tracking-widest rounded transition">
                        Update Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection