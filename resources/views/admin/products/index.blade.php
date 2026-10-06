@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="font-serif text-3xl font-bold text-luxury-gold uppercase tracking-widest">Catalog Management</h1>
            <p class="text-neutral-400 text-sm mt-1">Manage luxury items, pricing, inventory, and visibility.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-black font-semibold text-xs uppercase tracking-widest rounded transition">
            + Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-neutral-900 border border-neutral-800 rounded-lg overflow-hidden">
        <div class="p-4 border-b border-neutral-800">
            <form method="GET" action="{{ route('admin.products.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or SKU..." class="bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 w-full max-w-xs focus:outline-none focus:border-amber-500">
                <button type="submit" class="px-4 py-2 bg-neutral-800 border border-neutral-700 hover:border-amber-500 text-luxury-gold text-xs uppercase tracking-widest rounded">Filter</button>
            </form>
        </div>

        <table class="w-full text-left text-sm text-neutral-300">
            <thead class="bg-neutral-950 text-xs uppercase tracking-wider text-luxury-gold border-b border-neutral-800">
                <tr>
                    <th class="p-4">Item</th>
                    <th class="p-4">SKU</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Qty</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
                @forelse($products as $product)
                    <tr class="hover:bg-neutral-800/50 transition">
                        <td class="p-4 font-medium text-luxury-cream flex items-center gap-3">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" class="w-10 h-10 object-cover rounded border border-neutral-700">
                            @else
                                <div class="w-10 h-10 bg-neutral-800 rounded flex items-center justify-center text-[10px] text-neutral-500 border border-neutral-700">N/A</div>
                            @endif
                            <div>
                                <div>{{ $product->name }}</div>
                                @if($product->is_featured)
                                    <span class="text-[9px] text-amber-400 uppercase tracking-widest font-semibold">Featured</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 font-mono text-xs text-neutral-400">{{ $product->sku }}</td>
                        <td class="p-4 text-neutral-400 text-xs">{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="p-4 text-amber-400 font-semibold">${{ number_format($product->price, 2) }}</td>
                        <td class="p-4">{{ $product->quantity }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 text-[10px] uppercase font-bold tracking-wider rounded-full {{ $product->is_active ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/10 text-rose-400 border border-rose-500/30' }}">
                                {{ $product->is_active ? 'Active' : 'Draft' }}
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-amber-400 hover:text-amber-300 text-xs uppercase font-semibold">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this luxury item?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-rose-400 hover:text-rose-300 text-xs uppercase font-semibold">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-neutral-500">No items found in catalog.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-neutral-800">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection