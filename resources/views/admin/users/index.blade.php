@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Users Management</h1>
            <p class="text-gray-500 mt-1">Manage customer accounts</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Total Users</p>
            <p class="text-2xl font-bold">{{ $users->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Admin Users</p>
            <p class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'admin')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">Regular Users</p>
            <p class="text-2xl font-bold text-blue-600">{{ $users->where('role', 'user')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <p class="text-gray-500 text-sm">New This Month</p>
            <p class="text-2xl font-bold text-green-600">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Joined</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Orders</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm">#{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    @if($user->email_verified_at)
                                        <p class="text-xs text-green-600">✓ Verified</p>
                                    @else
                                        <p class="text-xs text-yellow-600">⚠ Unverified</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm">{{ $user->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role == 'admin')
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                    👑 Admin
                                </span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                    👤 User
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            {{ $user->created_at->format('M d, Y') }}
                            <br>
                            <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-orange-600">{{ $user->orders_count ?? 0 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition">
                                    Edit
                                </a>
                                @if($user->id !== Auth::id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete user {{ $user->name }}? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-6xl mb-4">👥</div>
                            <p class="text-lg">No users found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection