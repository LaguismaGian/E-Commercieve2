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
            <h1 class="font-serif text-4xl font-bold text-gray-900">Add New Product</h1>
            <p class="text-gray-500 mt-2">Craft a new listing for your candle collection.</p>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          CREATION FORM
    ════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-8 md:p-12">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                
                {{-- Basic Details --}}
                <div class="md:col-span-2">
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">Basic Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all font-serif text-lg placeholder-gray-300"
                                   placeholder="e.g. Midnight Lavender">
                            @error('name') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Category *</label>
                            <div class="relative group">
                                <select name="category" required
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm cursor-pointer appearance-none text-gray-700">
                                    
                                    {{-- Placeholder option --}}
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select a category</option>
                                    
                                    {{-- Category Options --}}
                                    <option value="Dessert Candles" {{ old('category') == 'Dessert Candles' ? 'selected' : '' }}>Dessert Candles</option>
                                    <option value="Unique Candles" {{ old('category') == 'Unique Candles' ? 'selected' : '' }}>Unique Candles</option>
                                    <option value="Flower Candles" {{ old('category') == 'Flower Candles' ? 'selected' : '' }}>Flower Candles</option>
                                    <option value="Limited Edition" {{ old('category') == 'Limited Edition' ? 'selected' : '' }}>Limited Edition</option>
                                    
                                </select>
                                
                                {{-- Custom Dropdown Arrow --}}
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400 group-hover:text-orange-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </div>
                            </div>
                            @error('category') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Pricing & Marketing --}}
                <div class="md:col-span-2">
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">Pricing & Marketing</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Current Price (₱) *</label>
                            <input type="number" name="price" step="0.01" value="{{ old('price') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm font-bold text-gray-900 placeholder-gray-300"
                                   placeholder="0.00">
                            @error('price') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Old Price (₱)</label>
                            <input type="number" name="old_price" step="0.01" value="{{ old('old_price') }}"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm text-gray-500 placeholder-gray-300"
                                   placeholder="For strikethrough">
                            @error('old_price') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Sale Status</label>
                            <div class="relative group">
                                <select name="on_sale" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm cursor-pointer appearance-none">
                                    <option value="0" {{ old('on_sale') == '0' ? 'selected' : '' }}>Regular Price</option>
                                    <option value="1" {{ old('on_sale') == '1' ? 'selected' : '' }}>Active Sale Badge</option>
                                </select>

                                {{-- Custom Dropdown Arrow --}}
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400 group-hover:text-orange-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </div>
                            </div>
                            @error('on_sale') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Inventory and Specs --}}
                <div class="md:col-span-2">
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">Inventory & Specs</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Stock Quantity *</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm placeholder-gray-300"
                                   placeholder="Units available">
                            @error('stock') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Weight (Grams) *</label>
                            <input type="number" name="grams" value="{{ old('grams') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm placeholder-gray-300"
                                   placeholder="e.g. 250">
                            @error('grams') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Media & Description --}}
                <div class="md:col-span-2">
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">Details & Media</h3>
                    
                    <div class="mb-5">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Product Description *</label>
                        <textarea name="description" rows="4" required
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm placeholder-gray-300 leading-relaxed"
                                  placeholder="Describe the scent profile, ingredients, and mood...">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Product Image</label>
                        <div class="relative group">
                            <input type="file" name="image" accept="image/*"
                                   class="w-full px-4 py-2.5 bg-gray-50 border border-dashed border-gray-200 rounded-xl file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white file:text-gray-700 file:shadow-sm hover:file:bg-orange-50 hover:file:text-orange-600 cursor-pointer transition-all text-sm text-gray-500">
                        </div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1.5 ml-1">Accepted formats: JPG, PNG (Max: 2MB)</p>
                        @error('image') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-6 py-3 rounded-xl font-bold text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all text-center uppercase tracking-widest">
                    Cancel
                </a>
                
                <button type="submit" 
                        class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-orange-500 transition-all active:scale-95 uppercase tracking-widest">
                    Add to Inventory
                </button>
            </div>
        </form>
    </div>
</div>
@endsection