@extends('admin.layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- ════════════════════════════════════════════
          PAGE HEADER
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="font-serif text-4xl font-bold text-gray-900">Product Inventory</h1>
            <p class="text-gray-500 mt-2">Manage your candle collections, stock levels, and pricing.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-3.5 rounded-full font-bold text-[11px] uppercase tracking-widest shadow-md hover:bg-orange-500 transition-all active:scale-95 flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New Product
        </a>
    </div>

    {{-- ════════════════════════════════════════════
          PRODUCTS DATA TABLE
    ════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Weight</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Stock</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        
                        {{-- Product Info & Image --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset('storage/images/' . $product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xl">🕯️</div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-brand-orange transition-colors">{{ $product->name }}</p>
                                    @if($product->on_sale)
                                        <span class="inline-block bg-red-50 border border-red-100 text-red-600 text-[9px] font-bold px-2 py-0.5 rounded-full mt-1.5 uppercase tracking-widest shadow-sm">On Sale</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- Category Pill --}}
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-gray-50 text-gray-500 border border-gray-100">
                                {{ $product->category ?? 'General' }}
                            </span>
                        </td>

                        {{-- Weight --}}
                        <td class="px-6 py-5 text-center">
                            <span class="text-sm font-medium text-gray-600">{{ $product->grams}}</span>
                        </td>

                        {{-- Price with Strikethrough Logic --}}
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-900 text-sm">₱{{ number_format($product->price, 2) }}</p>
                            @if($product->old_price)
                                <p class="text-[10px] font-bold text-gray-400 line-through mt-0.5 tracking-widest">₱{{ number_format($product->old_price, 2) }}</p>
                            @endif
                        </td>

                        {{-- Stock Status --}}
                        <td class="px-6 py-5">

                            @if($product->stock > 5)
                                <div class="flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                    <span class="text-xs font-bold text-green-600 uppercase tracking-widest">{{ $product->stock }} In Stock</span>
                                </div>
                            @elseif($product->stock > 0)
                                <div class="flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></div>
                                    <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">{{ $product->stock }} Left</span>
                                </div>
                            @else
                                <div class="flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                                    <span class="text-xs font-bold text-red-500 uppercase tracking-widest">Out of Stock</span>
                                </div>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-brand-orange hover:bg-orange-50 transition-colors" title="Edit Product">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Archive this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Archive Product">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4 text-3xl">
                                🕯️
                            </div>
                            <p class="font-serif text-2xl font-bold text-gray-900 mb-1">No products found.</p>
                            <p class="text-sm text-gray-500 mb-5">Your inventory is currently empty.</p>
                            <a href="{{ route('admin.products.create') }}" class="text-[10px] font-bold uppercase tracking-widest text-brand-orange hover:text-orange-600 transition-colors">
                                Add your first product →
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Block (Optional, but ready if needed) --}}
        @if(method_exists($products, 'hasPages') && $products->hasPages())
            <div class="px-6 py-5 border-t border-gray-100">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection