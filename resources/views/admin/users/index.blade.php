@extends('admin.layouts.admin')

@section('content')
<div class="space-y-8">
    
    {{-- ════════════════════════════════════════════
          PAGE HEADER
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="font-serif text-4xl font-bold text-gray-900">Customers & Users</h1>
            <p class="text-gray-500 mt-2">Manage accounts, assign roles, and view customer activity.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" 
           class="px-6 py-3 bg-white border border-gray-200 rounded-full text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-brand-orange hover:border-orange-200 transition-all shadow-sm">
            ← Back to Overview
        </a>
    </div>

    {{-- ════════════════════════════════════════════
          STATS SUMMARY
    ════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Users --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Total Users</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $users->total() }}</p>
            </div>
        </div>

        {{-- Admin Users --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Admin Team</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $users->where('role', 'admin')->count() }}</p>
            </div>
        </div>

        {{-- Regular Users --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Customers</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $users->where('role', 'user')->count() }}</p>
            </div>
        </div>

        {{-- New This Month --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex items-center gap-4 shadow-md">
            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">New This Month</p>
                <p class="text-2xl font-bold text-gray-900 font-mono">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          USERS DATA TABLE
    ════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Account Profile</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Joined Date</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Orders</th>
                        <th class="px-6 py-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        
                        {{-- User ID --}}
                        <td class="px-6 py-5">
                            <p class="font-bold text-gray-400 font-mono text-xs group-hover:text-brand-orange transition-colors">
                                #{{ $user->id }}
                            </p>
                        </td>

                        {{-- Profile Info --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 text-brand-orange flex items-center justify-center font-bold font-serif text-lg flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-bold text-gray-900 text-sm">{{ $user->name }}</p>
                                        @if($user->email_verified_at)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-blue-500" title="Verified">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Role Pill --}}
                        <td class="px-6 py-5">
                            @if($user->role == 'admin')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-slate-900 text-white shadow-sm">
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-gray-100 text-gray-500">
                                    Customer
                                </span>
                            @endif
                        </td>

                        {{-- Joined Date --}}
                        <td class="px-6 py-5">
                            <p class="text-sm font-medium text-gray-800">{{ $user->created_at->format('M d, Y') }}</p>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                        </td>

                        {{-- Orders Count --}}
                        <td class="px-6 py-5 text-center">
                            @if(($user->orders_count ?? 0) > 0)
                                <span class="font-mono font-bold text-brand-orange bg-orange-50 px-3 py-1 rounded-lg">
                                    {{ $user->orders_count }}
                                </span>
                            @else
                                <span class="font-mono text-gray-400">0</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-brand-orange hover:bg-orange-50 transition-colors" title="Edit User">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>

                                {{-- Delete Button (Protected against self-deletion) --}}
                                @if($user->id !== Auth::id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Delete User">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-20 text-center">
                            <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <span class="text-3xl">👥</span>
                            </div>
                            <p class="font-serif text-2xl font-bold text-gray-900 mb-1">No users found.</p>
                            <p class="text-sm text-gray-500">When customers register, they will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="px-6 py-5 border-t border-gray-100">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection