@extends('admin.layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold">Edit User</h1>
            <p class="text-gray-500 mt-1">Update user information</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Back to Users
        </a>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">User Role *</label>
                <div class="space-y-2">
                    <label class="flex items-center space-x-3 p-2 border rounded cursor-pointer hover:bg-gray-50">
                        <input type="radio" 
                               name="role" 
                               value="user" 
                               {{ $user->role == 'user' ? 'checked' : '' }}
                               class="w-4 h-4 text-orange-500">
                        <span class="font-medium">👤 Regular User</span>
                        <span class="text-sm text-gray-500 ml-auto">Can browse and purchase products</span>
                    </label>
                    <label class="flex items-center space-x-3 p-2 border rounded cursor-pointer hover:bg-gray-50">
                        <input type="radio" 
                               name="role" 
                               value="admin" 
                               {{ $user->role == 'admin' ? 'checked' : '' }}
                               class="w-4 h-4 text-orange-500">
                        <span class="font-medium">👑 Administrator</span>
                        <span class="text-sm text-gray-500 ml-auto">Full access to admin panel</span>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Verification Status -->
            <div class="mb-6 p-3 bg-gray-50 rounded">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold">Email Verification:</span>
                    @if($user->email_verified_at)
                        <span class="text-green-600">✓ Verified on {{ $user->email_verified_at->format('M d, Y') }}</span>
                    @else
                        <span class="text-yellow-600">⚠ Not verified</span>
                    @endif
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 font-semibold">
                    💾 Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection