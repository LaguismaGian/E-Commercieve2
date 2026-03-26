@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Orders</p>
                    <p class="text-2xl font-bold text-red-600">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-800">₱{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-orange-500 text-sm hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($recentOrders as $order)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">#{{ $order->order_number ?? $order->id }}</p>
                        <p class="text-sm text-gray-500">{{ $order->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">₱{{ number_format($order->total_amount, 2) }}</p>
                        <p class="text-xs {{ $order->status === 'pending' ? 'text-yellow-600' : 'text-green-600' }}">
                            {{ ucfirst($order->status) }}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center">No orders yet</p>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Low Stock Products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-orange-500 text-sm hover:underline">Manage</a>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts as $product)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">{{ $product->name }}</p>
                        <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                        Restock
                    </a>
                </div>
                @empty
                <p class="text-gray-500 text-center">All products have sufficient stock</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Recent Users</h2>
                <a href="{{ route('admin.users.index') }}" class="text-orange-500 text-sm hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($recentUsers as $user)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <p class="text-gray-500 text-center">No users yet</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.products.create') }}" class="bg-green-500 text-white p-3 rounded text-center hover:bg-green-600">
                    ➕ Add Product
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-blue-500 text-white p-3 rounded text-center hover:bg-blue-600">
                    📦 View Orders
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-purple-500 text-white p-3 rounded text-center hover:bg-purple-600">
                    👥 Manage Users
                </a>
                <a href="/shop" class="bg-orange-500 text-white p-3 rounded text-center hover:bg-orange-600">
                    🛍️ View Store
                </a>
            </div>
        </div>
    </div>
</div>
@endsection