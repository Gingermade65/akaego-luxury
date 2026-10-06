@extends('layouts.app')

@section('title', 'Admin - Order Management | AKAEGO LUXURY')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 border-b border-amber-500/20 pb-6">
        <div>
            <h1 class="text-3xl font-serif text-amber-200 uppercase tracking-widest">Order Management</h1>
            <p class="text-xs text-amber-100/60 uppercase tracking-widest mt-1">Boutique Operations & Client Fulfillment</p>
        </div>

        <!-- Filter Status Tabs -->
        <div class="flex flex-wrap gap-2 mt-4 md:mt-0">
            <a href="{{ route('admin.orders.index') }}" 
               class="px-4 py-2 text-xs uppercase tracking-widest rounded border transition {{ !$status ? 'bg-amber-500/20 text-amber-200 border-amber-500/50' : 'text-neutral-400 border-neutral-800 hover:text-white hover:border-neutral-700' }}">
                All Orders
            </a>
            @foreach(['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $st)
                <a href="{{ route('admin.orders.index', ['status' => $st]) }}" 
                   class="px-4 py-2 text-xs uppercase tracking-widest rounded border transition {{ $status === $st ? 'bg-amber-500/20 text-amber-200 border-amber-500/50' : 'text-neutral-400 border-neutral-800 hover:text-white hover:border-neutral-700' }}">
                    {{ ucfirst($st) }}
                </a>
            @endforeach
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-950/60 border border-emerald-500/30 text-emerald-300 text-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-16 bg-neutral-900/50 border border-neutral-800 rounded">
            <p class="text-neutral-400 font-serif">No orders found under this view.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-neutral-900/60 border border-neutral-800 rounded">
            <table class="w-full text-left text-sm text-neutral-300">
                <thead class="bg-neutral-900 text-xs uppercase tracking-widest text-amber-200/80 border-b border-neutral-800">
                    <tr>
                        <th class="py-4 px-6">Order Ref</th>
                        <th class="py-4 px-6">Client</th>
                        <th class="py-4 px-6">Total</th>
                        <th class="py-4 px-6">Payment</th>
                        <th class="py-4 px-6">Fulfillment</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-800/60">
                    @foreach($orders as $order)
                        <tr class="hover:bg-neutral-800/30 transition">
                            <td class="py-4 px-6 font-mono font-semibold text-amber-200">
                                #{{ $order->order_number }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-white">{{ $order->customer_name ?? ($order->user->name ?? 'Guest Client') }}</div>
                                <div class="text-xs text-neutral-500">{{ $order->customer_email ?? ($order->user->email ?? 'N/A') }}</div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-amber-100">
                                ₦{{ number_format($order->total, 2) }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider rounded border {{ $order->payment_status === 'paid' ? 'bg-emerald-950/60 text-emerald-400 border-emerald-800' : 'bg-amber-950/60 text-amber-400 border-amber-800' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider rounded border {{ $order->status === 'completed' ? 'bg-emerald-950/60 text-emerald-400 border-emerald-800' : ($order->status === 'cancelled' ? 'bg-rose-950/60 text-rose-400 border-rose-800' : 'bg-neutral-800 text-neutral-300 border-neutral-700') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-neutral-400">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="text-xs font-semibold text-amber-400 hover:text-amber-200 uppercase tracking-wider underline underline-offset-4">
                                    Manage
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection