@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Order #{{ $order->order_number ?? $order->id }}</h1>
            <p class="text-gray-500 mt-1">Placed on {{ $order->created_at->format('F j, Y g:i A') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details - Main Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Order Items</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-left">Product</th>
                                <th class="p-3 text-left">Price</th>
                                <th class="p-3 text-left">Quantity</th>
                                <th class="p-3 text-left">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr class="border-b">
                                <td class="p-3">{{ $item->product->name ?? $item->product_name }}</td>
                                <td class="p-3">₱{{ number_format($item->price, 2) }}</td>
                                <td class="p-3">{{ $item->quantity }}</td>
                                <td class="p-3 font-semibold">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr class="font-bold">
                                <td colspan="3" class="p-3 text-right">Total:</td>
                                <td class="p-3 text-orange-500 text-xl">₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Customer Notes -->
            @if($order->notes)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-2">Customer Notes</h2>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
            @endif

            <!-- Payment Proof -->
            @if($order->payment_proof)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-2">Payment Proof</h2>
                <p class="text-sm text-gray-600 mb-2">Reference: {{ $order->payment_reference }}</p>
                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    View Payment Screenshot
                </a>
            </div>
            @endif
        </div>

        <!-- Sidebar - Right Column -->
        <div class="space-y-6">
            <!-- Update Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Update Order Status</h2>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    <select name="status" class="w-full border rounded p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 w-full mt-2">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Update Payment Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Payment Status</h2>
                <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                    @csrf
                    <select name="payment_status" class="w-full border rounded p-2 mb-3 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending Verification</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full mt-2">
                        Update Payment
                    </button>
                </form>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Customer Information</h2>
                <p class="font-semibold">{{ $order->user->name }}</p>
                <p class="text-gray-600 text-sm">{{ $order->user->email }}</p>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Shipping Information</h2>
                <p class="text-gray-700">{{ $order->shipping_address }}</p>
                <p class="text-gray-700">{{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
                <p class="text-gray-700">Phone: {{ $order->shipping_phone }}</p>
            </div>
        </div>
    </div>
</div>
@endsection