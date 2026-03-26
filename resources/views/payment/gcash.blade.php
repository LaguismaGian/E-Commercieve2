<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Payment - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">GCash Payment</h1>
        <p class="mt-2 text-lg">Scan QR code to pay</p>
    </header>

    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 hover:text-orange-500">Home</a>
            <a href="/shop" class="text-gray-800 hover:text-orange-500">Shop</a>
        </div>
        <div class="flex items-center space-x-4">
            <span>Welcome, {{ Auth::user()->name }}! 👋</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                <p class="text-gray-600 mb-2">Order #: {{ $order->order_number }}</p>
                <p class="text-gray-600 mb-4">Total Amount: <span class="text-2xl font-bold text-orange-500">₱{{ number_format($order->total_amount, 2) }}</span></p>
                
                <div class="border-t pt-4 mt-4">
                    <h3 class="font-semibold mb-2">Items:</h3>
                    @foreach($order->orderItems as $item)
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $item->quantity }}x {{ $item->product->name }}</span>
                        <span>₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- GCash QR Code -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <h2 class="text-xl font-bold mb-4">Scan to Pay</h2>
                
                <!-- GCash QR Code Image - Replace with your actual GCash QR code -->
                <div class="bg-gray-100 p-8 rounded-lg mb-4 inline-block">
                    <img src="{{ asset('images/gcash-qr.png') }}" alt="GCash QR Code" class="w-64 h-64 mx-auto">
                    <p class="text-sm text-gray-500 mt-2">Scan this QR code using GCash app</p>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg mb-4">
                    <p class="font-semibold">GCash Number: <span class="text-orange-500">09123456789</span></p>
                    <p class="text-sm text-gray-600">Account Name: Candle Glow Shop</p>
                </div>

                <div class="border-t pt-4 mt-4">
                    <h3 class="font-semibold mb-3">After Payment, Submit Proof:</h3>
                    
                    <form action="{{ route('payment.verify', $order) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3 text-left">
                            <label class="block text-gray-700 mb-1">Reference Number *</label>
                            <input type="text" name="reference_number" required
                                   class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        
                        <div class="mb-3 text-left">
                            <label class="block text-gray-700 mb-1">Payment Screenshot *</label>
                            <input type="file" name="payment_screenshot" accept="image/*" required
                                   class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <p class="text-xs text-gray-500 mt-1">Upload screenshot of GCash payment confirmation</p>
                        </div>
                        
                        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 w-full font-semibold">
                            Submit Payment Proof
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('orders.show', $order) }}" class="text-orange-500 hover:underline">← View Order Details</a>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>