@extends('admin.layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    {{-- ════════════════════════════════════════════
          PAGE HEADER
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-orange-500 transition-colors flex items-center gap-1 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Inventory
            </a>
            <h2 class="font-serif text-4xl font-bold text-gray-900">Modify Collection</h2>
            <p class="text-gray-500 mt-2">Update the details or imagery for <span class="text-gray-900 font-semibold">"{{ $product->name }}"</span>.</p>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          ERROR HANDLING
    ════════════════════════════════════════════ --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-100 text-red-700 px-6 py-4 rounded-2xl mb-8">
            <p class="text-[11px] font-bold uppercase tracking-widest mb-2">Check the following errors:</p>
            <ul class="list-disc list-inside text-sm font-medium">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ════════════════════════════════════════════
          EDIT FORM
    ════════════════════════════════════════════ --}}
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left: Visual Content --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Current Media</label>
                    
                    <div class="mb-6 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 aspect-square">
                        @if($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" class="w-full h-full object-cover shadow-inner">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl">🕯️</div>
                        @endif
                    </div>

                    <div class="relative group cursor-pointer border-2 border-dashed border-gray-100 rounded-2xl p-6 transition-all hover:border-orange-200 hover:bg-orange-50/30 text-center">
                        <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <div class="space-y-1">
                            <p class="text-xs font-bold text-gray-600">Replace Photo</p>
                            <p class="text-[10px] text-gray-400">Leave empty to keep current</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Product Details --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- General Info Card --}}
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full bg-gray-50/50 border border-gray-100 rounded-xl px-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category', $product->category) }}"
                                class="w-full bg-gray-50/50 border border-gray-100 rounded-xl px-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Weight / Size</label>
                            <input type="text" name="grams" value="{{ old('grams', $product->grams) }}"
                                class="w-full bg-gray-50/50 border border-gray-100 rounded-xl px-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full bg-gray-50/50 border border-gray-100 rounded-2xl px-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                {{-- Inventory & Pricing Card --}}
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Price (₱)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-400 text-sm">₱</span>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full bg-gray-50/50 border border-gray-100 rounded-xl pl-8 pr-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>
                            </div>
                        </div> 

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Stock Level</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                class="w-full bg-gray-50/50 border border-gray-100 rounded-xl px-4 py-3 text-sm transition-all focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="flex items-center cursor-pointer gap-3">
                                <div class="relative">
                                    <input type="checkbox" name="on_sale" value="1" {{ $product->on_sale ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-orange-500"></div>
                                </div>
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Mark as Sale</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-gray-900 transition-colors">
                        Cancel Changes
                    </a>
                    <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-xs font-bold tracking-widest hover:bg-orange-500 transition-all shadow-lg shadow-gray-200 uppercase active:scale-95">
                        Update Product
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection