<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Admin Header -->
    <div class="bg-gray-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🕯️ Candle Glow Admin</h1>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ Auth::user()->name }}</span>
                <a href="/" class="bg-blue-600 px-4 py-2 rounded text-sm hover:bg-blue-700">View Store</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 px-4 py-2 rounded text-sm hover:bg-red-700">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Products Management</h1>
            <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Add New Product
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Image</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Category</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Stock</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">{{ $product->id }}</td>
                        <td class="px-6 py-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-2xl">🕯️</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->category ?? 'Uncategorized' }}</td>
                        <td class="px-6 py-4">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($product->stock > 0)
                                <span class="text-green-600">{{ $product->stock }}</span>
                            @else
                                <span class="text-red-600">Out of Stock</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 inline-block mr-2">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600" onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No products yet. Click "Add New Product" to get started!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>