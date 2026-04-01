@extends('admin.layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- ════════════════════════════════════════════
          DASHBOARD HEADER
    ════════════════════════════════════════════ --}}
    <div>
        <h1 class="font-serif text-4xl font-bold text-gray-900">Dashboard Overview</h1>
        <p class="text-gray-500 mt-2">Welcome back. Here is what is happening with Daily Essentials today.</p>
    </div>

    {{-- ════════════════════════════════════════════
          TOP METRICS ROW
    ════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
        
        {{-- Total Revenue --}}
        <div class="bg-slate-900 rounded-[2rem] shadow-lg p-6 lg:col-span-2 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-orange-500/20 rounded-full blur-2xl group-hover:bg-orange-500/30 transition-all"></div>
            
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div class="flex items-center gap-3 text-white mb-6">
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-gray-300">Total Revenue</span>
                </div>
                <div>
                    <p class="text-4xl font-black text-white font-mono">₱{{ number_format($totalRevenue, 2) }}</p>
                    <p class="text-sm text-gray-400 mt-2">All-time store earnings</p>
                </div>
            </div>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg p-6 flex flex-col justify-between">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Pending</span>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-900 font-mono">{{ $pendingOrders }}</p>
                <p class="text-xs font-medium text-red-500 mt-1">Requires action</p>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg p-6 flex flex-col justify-between">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Orders</span>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-900 font-mono">{{ $totalOrders }}</p>
                <p class="text-xs font-medium text-gray-500 mt-1">Total placed</p>
            </div>
        </div>

        {{-- Total Users --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-lg p-6 flex flex-col justify-between">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-orange-50 text-brand-orange flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Customers</span>
            </div>
            <div>
                <p class="text-3xl font-bold text-gray-900 font-mono">{{ $totalUsers }}</p>
                <p class="text-xs font-medium text-gray-500 mt-1">Registered accounts</p>
            </div>
        </div>

    </div>

    {{-- ════════════════════════════════════════════
          SECONDARY METRICS & DATA GRIDS
    ════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- Recent Orders Widget --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-md overflow-hidden flex flex-col">
            <div class="p-6 md:p-8 flex justify-between items-center border-b border-gray-50">
                <h2 class="font-serif text-2xl font-bold text-gray-900">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-brand-orange hover:text-orange-600 transition-colors">View All</a>
            </div>
            <div class="p-6 md:p-8 flex-grow">
                <div class="space-y-6">
                    @forelse($recentOrders as $order)
                    <div class="flex justify-between items-center group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-orange-50 group-hover:text-brand-orange transition-colors">
                                <span class="font-serif text-lg">📦</span>
                            </div>
                            <div>
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-gray-900 hover:text-brand-orange transition-colors">
                                    #{{ $order->order_number ?? $order->id }}
                                </a>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $order->user->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900 font-mono">₱{{ number_format($order->total_amount, 2) }}</p>
                            <p class="text-[10px] font-bold uppercase tracking-widest mt-1 {{ $order->status === 'pending' ? 'text-yellow-500' : 'text-green-500' }}">
                                {{ $order->status }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-400 font-medium">No recent orders found.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Low Stock Alerts Widget --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-md overflow-hidden flex flex-col">
            <div class="p-6 md:p-8 flex justify-between items-center border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <h2 class="font-serif text-2xl font-bold text-gray-900">Inventory Alerts</h2>
                    @if($lowStockProducts->count() > 0)
                        <span class="bg-red-100 text-red-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-widest">{{ $lowStockProducts->count() }} Low</span>
                    @endif
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 transition-colors">Manage</a>
            </div>
            <div class="p-6 md:p-8 flex-grow">
                <div class="space-y-6">
                    @forelse($lowStockProducts as $product)
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('images/products/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xl">🕯️</div>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm line-clamp-1">{{ $product->name }}</p>
                                <p class="text-xs text-red-500 font-medium mt-0.5">Only {{ $product->stock }} left in stock</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="flex-shrink-0 bg-gray-50 text-gray-600 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all">
                            Restock
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-8 flex flex-col items-center">
                        <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </div>
                        <p class="text-gray-900 font-bold">Inventory is healthy</p>
                        <p class="text-sm text-gray-500 mt-1">All products have sufficient stock levels.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Quick Actions Widget --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-md overflow-hidden lg:col-span-2">
            <div class="p-6 md:p-8 border-b border-gray-50">
                <h2 class="font-serif text-2xl font-bold text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    
                    <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center justify-center p-6 rounded-2xl bg-orange-50 text-brand-orange hover:bg-brand-orange hover:text-white transition-all group border border-orange-100 text-center">
                        <div class="w-10 h-10 rounded-full bg-white/50 flex items-center justify-center mb-3 group-hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest">Add Product</span>
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center p-6 rounded-2xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all group border border-blue-100 text-center">
                        <div class="w-10 h-10 rounded-full bg-white/50 flex items-center justify-center mb-3 group-hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest">View Orders</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center p-6 rounded-2xl bg-purple-50 text-purple-600 hover:bg-purple-600 hover:text-white transition-all group border border-purple-100 text-center">
                        <div class="w-10 h-10 rounded-full bg-white/50 flex items-center justify-center mb-3 group-hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest">Manage Users</span>
                    </a>

                    <a href="/shop" class="flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-100 text-slate-700 hover:bg-slate-900 hover:text-white transition-all group border border-slate-200 text-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mb-3 group-hover:bg-white/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest">View Store</span>
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection