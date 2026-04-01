@extends('admin.layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- ════════════════════════════════════════════
          PAGE HEADER
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="font-serif text-4xl font-bold text-gray-900">Orders Management</h1>
            <p class="text-gray-500 mt-2">Track, update, and fulfill customer purchases.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" 
           class="px-6 py-3 bg-white border border-gray-200 rounded-full text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-orange hover:border-orange-200 transition-all shadow-sm">
            ← Back to Overview
        </a>
    </div>

    {{-- ════════════════════════════════════════════
          STATS SUMMARY
    ════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Orders --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-lg">
            <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $orders->total() }}</p>
            </div>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-lg">
            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Pending</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $orders->where('status', 'pending')->count() }}</p>
            </div>
        </div>

        {{-- Completed Orders --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-lg">
            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Completed</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $orders->where('status', 'completed')->count() }}</p>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-lg">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Revenue</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">₱{{ number_format($orders->sum('total_amount'), 0) }}</p>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          ORDERS DATA TABLE
    ════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order Details</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Payment</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        
                        {{-- ID & Date --}}
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-900 font-mono text-sm group-hover:text-brand-orange transition-colors">
                                #{{ $order->order_number ?? $order->id }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ $order->created_at->format('M d, Y') }} &bull; {{ $order->created_at->format('h:i A') }}
                            </p>
                        </td>

                        {{-- Customer --}}
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-800 text-sm">{{ $order->user->name }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $order->user->email }}</p>
                        </td>

                        {{-- Order Status Pill --}}
                        <td class="px-6 py-5">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                    'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'completed' => 'bg-green-50 text-green-600 border-green-100',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                ];
                                $colorClass = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $colorClass }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        {{-- Payment Status Pill --}}
                        <td class="px-6 py-5">
                            @php
                                $payColors = [
                                    'paid' => 'bg-green-50 text-green-600 border-green-100',
                                    'pending' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                    'awaiting_verification' => 'bg-purple-50 text-purple-600 border-purple-100',
                                    'unpaid' => 'bg-gray-50 text-gray-500 border-gray-100',
                                    'failed' => 'bg-red-50 text-red-600 border-red-100',
                                ];
                                $payStatus = $order->payment_status ?? 'unpaid';
                                $payColorClass = $payColors[$payStatus] ?? 'bg-gray-50 text-gray-500 border-gray-100';
                            @endphp
                            <div class="flex flex-col items-start gap-1">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $payColorClass }}">
                                    {{ str_replace('_', ' ', $payStatus) }}
                                </span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $order->payment_method }}</span>
                            </div>
                        </td>

                        {{-- Total --}}
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-900 font-mono">₱{{ number_format($order->total_amount, 2) }}</p>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" 
                               class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 hover:bg-brand-orange hover:text-white transition-all">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <span class="text-3xl">📦</span>
                            </div>
                            <p class="font-serif text-2xl font-bold text-gray-900 mb-1">No orders yet.</p>
                            <p class="text-sm text-gray-500">When customers place orders, they will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
            <div class="px-6 py-5 border-t border-gray-100">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection