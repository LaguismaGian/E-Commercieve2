<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="text-green-500 text-6xl mb-4">✓</div>
            <h1 class="text-2xl font-bold mb-4">Order Placed Successfully!</h1>
            <p class="text-gray-600 mb-2">Order #: {{ $order->order_number }}</p>
            <p class="text-gray-600 mb-6">Total: ${{ number_format($order->total_amount, 2) }}</p>
            <p class="text-gray-600 mb-6">We'll notify you when your order ships.</p>
            <a href="/shop" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
                Continue Shopping
            </a>
        </div>
    </div>
</body>
</html>