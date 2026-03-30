@extends('admin.layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    
    {{-- ════════════════════════════════════════════
          PAGE HEADER
    ════════════════════════════════════════════ --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <a href="{{ route('admin.users.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-orange-500 transition-colors flex items-center gap-1 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Users
            </a>
            <h1 class="font-serif text-4xl font-bold text-gray-900">Edit Profile</h1>
            <p class="text-gray-500 mt-2">Update account details and manage system access.</p>
        </div>
    </div>

    {{-- ════════════════════════════════════════════
          EDIT FORM CARD
    ════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-12">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                
                {{-- Basic Information --}}
                <div>
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">Personal Details</h3>
                    <div class="space-y-5">
                        
                        {{-- Full Name --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all font-serif text-lg placeholder-gray-300">
                            @error('name') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email Address --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Email Address *</label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all text-sm placeholder-gray-300 pr-12">
                                
                                {{-- Verification Badge inside input --}}
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    @if($user->email_verified_at)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-blue-500" title="Verified">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-300" title="Unverified">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            @error('email') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>

                {{-- Access & Roles --}}
                <div>
                    <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5">System Access</h3>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Account Role *</label>
                        
                        <div class="grid grid-cols-1 gap-3">
                            {{-- Regular User Option --}}
                            <label class="relative flex cursor-pointer rounded-xl border border-gray-100 bg-white p-4 shadow-sm focus:outline-none transition-all has-[:checked]:border-orange-500 has-[:checked]:ring-1 has-[:checked]:ring-orange-500 hover:bg-gray-50 group">
                                <input type="radio" name="role" value="user" class="peer sr-only" {{ old('role', $user->role) == 'user' ? 'checked' : '' }}>
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span class="block text-sm font-bold text-blue-600 mb-0.5">Customer Account</span>
                                        <span class="block text-xs text-gray-500">Standard access. Can browse the store and purchase products.</span>
                                    </span>
                                </span>
                                {{-- Custom Radio Circle --}}
                                <svg class="h-5 w-5 text-brand-orange hidden peer-checked:block transition-all" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                <div class="h-5 w-5 rounded-full border border-gray-300 peer-checked:hidden group-hover:border-orange-200 transition-all"></div>
                            </label>

                            {{-- Admin Option --}}
                            <label class="relative flex cursor-pointer rounded-xl border border-gray-100 bg-white p-4 shadow-sm focus:outline-none transition-all has-[:checked]:border-orange-500 has-[:checked]:ring-1 has-[:checked]:ring-orange-500 hover:bg-gray-50 group">
                                <input type="radio" name="role" value="admin" class="peer sr-only" {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}>
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span class="block text-sm font-bold text-red-600 mb-0.5">Administrator</span>
                                        <span class="block text-xs text-gray-500">Full access. Can manage inventory, fulfill orders, and edit users.</span>
                                    </span>
                                </span>
                                {{-- Custom Radio Circle --}}
                                <svg class="h-5 w-5 text-brand-orange hidden peer-checked:block transition-all" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                <div class="h-5 w-5 rounded-full border border-gray-300 peer-checked:hidden group-hover:border-orange-200 transition-all"></div>
                            </label>
                        </div>
                        @error('role') <p class="text-red-500 text-xs mt-1.5 ml-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-3 rounded-xl font-bold text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-all text-center">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-orange-500 transition-all active:scale-95">
                    Update Account
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection