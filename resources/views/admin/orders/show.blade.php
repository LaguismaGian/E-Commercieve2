@extends('admin.layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- ════════════════════════════════════════════
          PAGE HEADER & BACK BUTTON
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
        <div>
            <div class="flex items-center gap-4 flex-wrap mb-2">
                <h1 class="font-serif text-4xl font-bold text-gray-900">Order #{{ $order->order_number ?? $order->id }}</h1>
                
                {{-- Quick Status Indicators --}}
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                        'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                        'completed' => 'bg-green-50 text-green-600 border-green-100',
                        'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                    ];
                    $payColors = [
                        'paid' => 'bg-green-50 text-green-600 border-green-100',
                        'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                        'awaiting_verification' => 'bg-purple-50 text-purple-600 border-purple-100',
                        'unpaid' => 'bg-gray-50 text-gray-500 border-gray-100',
                        'failed' => 'bg-red-50 text-red-600 border-red-100',
                    ];
                @endphp
                <span class="hidden sm:inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border {{ $statusColors[$order->status] ?? 'bg-gray-50' }}">
                    {{ $order->status }}
                </span>
                <span class="hidden sm:inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border {{ $payColors[$order->payment_status] ?? 'bg-gray-50' }}">
                    {{ str_replace('_', ' ', $order->payment_status ?? 'unpaid') }}
                </span>
            </div>
            <p class="text-gray-500">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
        
        <a href="{{ route('admin.orders.index') }}" 
           class="self-start px-6 py-3 bg-white border border-gray-200 rounded-full text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-orange hover:border-orange-200 transition-all shadow-sm flex-shrink-0">
            ← Back to Orders
        </a>
    </div>

    {{-- ════════════════════════════════════════════
          MAIN CONTENT GRID
    ════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT COLUMN: Items & Details --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Order Items Table --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50">
                    <h2 class="font-serif text-2xl font-bold text-gray-900">Purchased Items</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Qty</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($order->orderItems as $item)
                            <tr class="hover:bg-gray-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <p class="font-bold text-gray-900">{{ $item->product->name ?? $item->product_name }}</p>
                                    @if($item->scent)
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-brand-orange mt-0.5">Scent: {{ $item->scent }}</p>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-600 font-mono">₱{{ number_format($item->price, 2) }}</td>
                                <td class="px-8 py-5 text-sm font-bold text-gray-900 text-center">{{ $item->quantity }}</td>
                                <td class="px-8 py-5 text-right font-bold text-gray-900 font-mono">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-orange-50/30 border-t border-gray-100">
                            <tr>
                                <td colspan="3" class="px-8 py-6 text-right text-xs font-bold uppercase tracking-widest text-gray-500">Order Total</td>
                                <td class="px-8 py-6 text-right font-black text-brand-orange text-xl font-mono">₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Two Column Split: Notes & Proof --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Payment Proof --}}
                @if($order->payment_method === 'gcash' && $order->payment_proof)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /></svg>
                        </div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">GCash Proof</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Reference Number</p>
                            <p class="font-mono text-gray-900 font-bold bg-gray-50 px-3 py-2 rounded-lg inline-block border border-gray-100">{{ $order->payment_reference }}</p>
                        </div>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" 
                           class="block w-full text-center bg-gray-50 border border-gray-200 text-gray-600 px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-brand-orange hover:border-orange-200 transition-all">
                            View Screenshot
                        </a>
                    </div>
                </div>
                @endif

                {{-- Customer Notes --}}
                @if($order->notes)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                        </div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">Order Notes</h2>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed italic bg-gray-50 p-4 rounded-xl border border-gray-100">"{{ $order->notes }}"</p>
                </div>
                @endif
            </div>
        </div>

        {{-- RIGHT COLUMN: Management & Details --}}
        <div class="space-y-8">
            
            {{-- Status Management Controls --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <h2 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-50 pb-4 mb-6">Manage Order</h2>
                
                {{-- Delivery Status Form --}}
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mb-6">
                    @csrf
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Delivery Status</label>
                    <div class="flex gap-2">
                        <select name="status" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 text-sm font-medium text-gray-700 appearance-none cursor-pointer">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-slate-900 text-white px-5 rounded-xl font-bold hover:bg-brand-orange transition-all active:scale-95 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </button>
                    </div>
                </form>

                {{-- Payment Status Form --}}
                <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                    @csrf
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Payment Status</label>
                    <div class="flex gap-2">
                        <select name="payment_status" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-green-500 text-sm font-medium text-gray-700 appearance-none cursor-pointer">
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="awaiting_verification" {{ $order->payment_status == 'awaiting_verification' ? 'selected' : '' }}>Awaiting Verification</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        <button type="submit" class="bg-slate-900 text-white px-5 rounded-xl font-bold hover:bg-green-600 transition-all active:scale-95 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Customer Information --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                <h2 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-50 pb-4 mb-5">Customer Profile</h2>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-orange-100 text-brand-orange flex items-center justify-center font-bold text-lg font-serif">
                        {{ substr($order->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>

                <div class="space-y-4 bg-gray-50 p-5 rounded-xl border border-gray-100">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Phone Number</p>
                        <p class="text-sm font-medium text-gray-900">{{ $order->shipping_phone }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Delivery Address</p>
                        <p class="text-sm font-medium text-gray-900 leading-relaxed">
                            {{ $order->shipping_address }}<br>
                            {{ $order->shipping_city }} {{ $order->shipping_postal_code }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection