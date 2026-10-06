@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="text-xs text-neutral-400 hover:text-luxury-gold uppercase tracking-widest mb-2 inline-block">&larr; Back to Catalog</a>
        <h1 class="font-serif text-3xl font-bold text-luxury-gold uppercase tracking-widest">Edit: {{ $product->name }}</h1>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-neutral-900 border border-neutral-800 rounded-lg p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Item Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Category</label>
                <select name="category_id" required class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Quantity (Stock)</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0" class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Price ($)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required min="0" class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Compare At Price ($)</label>
                <input type="number" step="0.01" name="compare_at_price" value="{{ old('compare_at_price', $product->compare_at_price) }}" min="0" class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">
            </div>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Summary</label>
            <textarea name="summary" rows="2" class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">{{ old('summary', $product->summary) }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Full Description</label>
            <textarea name="description" rows="4" class="w-full bg-neutral-800 border border-neutral-700 text-luxury-cream text-sm rounded px-3 py-2 focus:outline-none focus:border-amber-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs uppercase tracking-widest text-luxury-gold mb-2">Replace / Add Primary Image</label>
            <input type="file" name="image" accept="image/*" class="w-full bg-neutral-800 border border-neutral-700 text-neutral-400 text-sm rounded px-3 py-2">
            @if($product->primaryImage)
                <div class="mt-2 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" class="w-12 h-12 object-cover rounded border border-neutral-700">
                    <span class="text-xs text-neutral-400">Current primary image</span>
                </div>
            @endif
        </div>

        <div class="flex gap-6 pt-2">
            <label class="flex items-center gap-2 text-xs uppercase tracking-wider text-luxury-cream cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded border-neutral-700 text-amber-500 focus:ring-amber-500">
                Active in Storefront
            </label>

            <label class="flex items-center gap-2 text-xs uppercase tracking-wider text-luxury-cream cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded border-neutral-700 text-amber-500 focus:ring-amber-500">
                Featured Product
            </label>
        </div>

        <div class="pt-4 border-t border-neutral-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-400 text-black font-semibold text-xs uppercase tracking-widest rounded transition">Update Item</button>
        </div>
    </form>
</div>
@endsection