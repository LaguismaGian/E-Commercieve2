@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Orders Management</h1>
            <p class="text-gray-500 mt-1">Manage customer orders</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Total Orders</p>
            <p class="text-2xl font-bold">{{ $orders->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Pending</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Completed</p>
            <p class="text-2xl font-bold text-green-600">{{ $orders->where('status', 'completed')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Total Revenue</p>
            <p class="text-2xl font-bold text-orange-600">₱{{ number_format($orders->sum('total_amount'), 2) }}</p>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Order ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Customer</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Payment</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-mono text-sm">
                            #{{ $order->order_number ?? $order->id }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold">{{ $order->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            {{ $order->created_at->format('M d, Y') }}
                            <br>
                            <span class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4 font-semibold">
                            ₱{{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($order->payment_status == 'paid') bg-green-100 text-green-800
                                @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->payment_status == 'unpaid') bg-gray-100 text-gray-800
                                @elseif($order->payment_status == 'failed') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($order->payment_status ?? 'unpaid') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order) }}" 
                               class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition inline-block">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-6xl mb-4">📦</div>
                            <p class="text-lg">No orders found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection