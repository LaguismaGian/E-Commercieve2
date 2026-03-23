<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Admin Header -->
    <div class="bg-gray-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🕯️ Candle Glow Admin</h1>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 px-4 py-2 rounded text-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Edit Product</h1>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                ← Back to Products
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category', $product->category) }}" class="w-full p-2 border rounded">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Price ($) *</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Stock Quantity *</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full p-2 border rounded" required>
                        </div>
                    </div>

                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Current Image</label>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded mb-2">
                            @else
                                <div class="w-32 h-32 bg-gray-200 rounded flex items-center justify-center mb-2">No Image</div>
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full p-2 border rounded">
                            <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                        </div>

                        <div class="mb-4">  
                            <label class="block text-gray-700 font-semibold mb-2">Description *</label>
                            <textarea name="description" rows="6" class="w-full p-2 border rounded" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-6 pt-4 border-t">
                    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>