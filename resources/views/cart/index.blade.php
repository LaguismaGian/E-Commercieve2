@extends('layouts.navbar')

@section('title', 'Your Cart | Daily Essentials')

@section('content')

    {{-- ════════════════════════════════════════════
         TOP PAGE HERO
    ════════════════════════════════════════════ --}}
    <section class="relative min-h-[250px] flex flex-col items-center justify-center text-center px-6" 
             style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/bgphoto2.png') }}'); background-size: cover; background-position: center;">
        <h1 class="font-inria text-white text-4xl md:text-5xl font-bold tracking-tight mb-2">
            Your Shopping Cart
        </h1>
        <p class="text-white/90 text-sm tracking-widest uppercase font-medium">Review your items before checkout</p>
    </section>
    
    {{-- ════════════════════════════════════════════
         CART CONTENT
    ════════════════════════════════════════════ --}}
    <main class="max-w-7xl mx-auto px-6 py-12">
        
        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 animate-fade-out shadow-sm">
                <div class="bg-green-500 text-white rounded-full p-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-100 text-red-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm">
                <div class="bg-red-500 text-white rounded-full p-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-wide">{{ session('error') }}</span>
            </div>
        @endif

        {{-- ADMIN MANAGEMENT --}}
        @auth
            @if(Auth::user()->isAdmin())
                <div class="mb-8 p-4 bg-orange-50 border border-orange-100 rounded-2xl flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-800 font-bold text-sm">Store Management</h3>
                        <p class="text-orange-600 text-[11px]">You are logged in as an administrator.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.products.index') }}" 
                           class="text-xs font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl transition-all shadow-sm">
                            View Inventory
                        </a>
                        <a href="{{ route('admin.products.create') }}" 
                           class="text-xs font-semibold text-white bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span>+</span> Add Product
                        </a>
                    </div>
                </div>
            @endif
        @endauth

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[700px]">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="p-6 text-center w-16">
                                    {{-- checkbox --}}
                                    <label class="relative flex items-center justify-center cursor-pointer group">
                                        {{-- The real input is hidden using 'sr-only' but still tracks the clicks --}}
                                        <input type="checkbox" id="select-all" class="peer sr-only" checked>
                                        
                                        {{-- orange circle --}}
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 bg-white peer-checked:bg-orange-500 peer-checked:border-orange-500 transition-all duration-200 flex items-center justify-center shadow-sm group-hover:border-orange-400">
                                        </div>
                                    </label>
                                </th>
                                
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Price</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Quantity</th>
                                <th class="p-6 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Subtotal</th>
                                <th class="p-6"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @foreach($cartItems as $item)
                            <tr class="group hover:bg-gray-50/50 transition-colors">
                                
                                <td class="p-6 text-center">
                                    {{-- checkbox --}}
                                    <label class="relative flex items-center justify-center cursor-pointer group">
                                        {{-- Notice 'item-checkbox' is still here so our Javascript can find it! --}}
                                        <input type="checkbox" value="{{ $item->id }}" data-price="{{ $item->product->price * $item->quantity }}" class="item-checkbox peer sr-only" checked>
                                        
                                        {{-- orange circle --}}
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 bg-white peer-checked:bg-orange-500 peer-checked:border-orange-500 transition-all duration-200 flex items-center justify-center shadow-sm group-hover:border-orange-400">
                                        </div>
                                    </label>
                                </td>
                                
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex-shrink-0">
                                            @if($item->product->image)
                                                <img src="{{ asset('images/products/' . $item->product->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-2xl">🕯️</div>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('shop.show', $item->product->id) }}" class="font-inria font-bold text-gray-900 text-lg group-hover:text-brand-orange transition-colors">
                                                {{ $item->product->name }}
                                            </a>
                                            <div class="flex flex-col gap-1 mt-1">
                                                <span class="text-[10px] text-orange-500 font-bold uppercase tracking-tighter">
                                                    {{ $item->product->category }}
                                                </span>
                                                <div class="flex items-center gap-1.5 mt-1">
                                                    <span class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">Scent:</span>
                                                    <span class="text-[11px] text-gray-700 font-bold bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">
                                                        {{ $item->scent ?? 'Default' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6 text-center font-medium text-gray-600">₱{{ number_format($item->product->price, 2) }}</td>
                                <td class="p-6">
                                    {{-- RESTORED: Your fully functional Add/Subtract forms! --}}
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('cart.update', $item) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                            <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:border-orange-500 hover:text-brand-orange hover:shadow-sm transition-all" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <span class="w-8 text-center font-bold">{{ $item->quantity }}</span>
                                        <form action="{{ route('cart.update', $item) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                            <button type="submit" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center hover:bg-white hover:border-orange-500 hover:text-brand-orange hover:shadow-sm transition-all" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="p-6 text-center font-bold text-gray-900">₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td class="p-6 text-right">
                                    {{-- RESTORED: Your Delete Form! --}}
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 hover:bg-red-50 p-2 rounded-xl transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="space-y-4">
                    <a href="/shop" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <div class="w-full md:w-96 bg-gray-50 rounded-[2rem] p-8 space-y-6 border border-gray-100">
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="text-lg font-inria font-bold text-gray-900">Selected Total</span>
                        <span id="dynamic-total" class="text-2xl font-bold text-orange-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                    {{-- Notice this is now a button of type="button", Javascript handles the rest! --}}
                    <button type="button" id="checkout-btn" class="block w-full bg-slate-900 text-white text-center py-4 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-[0.2em] disabled:opacity-50 disabled:cursor-not-allowed">
                        PROCEED TO CHECKOUT
                    </button>
                </div>
            </div>
        @else

            <div class="text-center py-24 bg-gray-50 rounded-[3rem] border border-dashed border-gray-200 mx-auto max-w-3xl">
    <div class="mb-6 opacity-70">
        
        <svg class="w-32 h-32 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier"> 
                <path d="M16.25 22.5C17.2165 22.5 18 21.7165 18 20.75C18 19.7835 17.2165 19 16.25 19C15.2835 19 14.5 19.7835 14.5 20.75C14.5 21.7165 15.2835 22.5 16.25 22.5Z" fill="#d66000"></path> 
                <path d="M8.25 22.5C9.2165 22.5 10 21.7165 10 20.75C10 19.7835 9.2165 19 8.25 19C7.2835 19 6.5 19.7835 6.5 20.75C6.5 21.7165 7.2835 22.5 8.25 22.5Z" fill="#d66000"></path> 
                <path opacity="100" d="M4.84 3.94L4.64 6.39C4.6 6.86 4.97 7.25 5.44 7.25H20.75C21.17 7.25 21.52 6.92999 21.55 6.50999C21.68 4.73999 20.33 3.3 18.56 3.3H6.28999C6.18999 2.86 5.98999 2.44 5.67999 2.09C5.18999 1.56 4.49 1.25 3.77 1.25H2C1.59 1.25 1.25 1.59 1.25 2C1.25 2.41 1.59 2.75 2 2.75H3.74001C4.05001 2.75 4.34 2.88001 4.55 3.10001C4.76 3.33001 4.86 3.63 4.84 3.94Z" fill="#d66000"></path> 
                <path d="M20.5101 8.75H5.17006C4.75006 8.75 4.41005 9.07 4.37005 9.48L4.01005 13.83C3.87005 15.53 5.21006 17 6.92006 17H18.0401C19.5401 17 20.8601 15.77 20.9701 14.27L21.3001 9.60001C21.3401 9.14001 20.9801 8.75 20.5101 8.75Z" fill="#d66000"></path> 
            </g>
        </svg>
    </div>
    <h2 class="font-inria text-2xl font-bold text-gray-900 mb-2">Your cart is currently empty</h2>
    <p class="text-gray-500 mb-8">Looks like you haven't added any candles yet.</p>
    <a href="/shop" class="inline-block bg-slate-900 text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-orange-500 transition-all active:scale-95 text-xs tracking-widest uppercase">
        Start Shopping
    </a>
</div>
        @endif
    </main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const selectAllCheckbox = document.getElementById('select-all');
        const totalDisplay = document.getElementById('dynamic-total');
        const checkoutBtn = document.getElementById('checkout-btn');

        // Math recalculation
        function calculateTotal() {
            let newTotal = 0;
            let checkedCount = 0;

            itemCheckboxes.forEach(box => {
                if (box.checked) {
                    newTotal += parseFloat(box.dataset.price);
                    checkedCount++;
                }
            });

            totalDisplay.innerText = '₱' + newTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            checkoutBtn.disabled = checkedCount === 0;
            selectAllCheckbox.checked = checkedCount === itemCheckboxes.length && itemCheckboxes.length > 0;
        }

        itemCheckboxes.forEach(box => box.addEventListener('change', calculateTotal));

        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(box => box.checked = selectAllCheckbox.checked);
            calculateTotal();
        });

        calculateTotal();

        // THE FIX: Securely submit only the checked items without breaking HTML rules!
        checkoutBtn.addEventListener('click', function() {
            // Create a hidden form in memory
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = "{{ route('checkout.index') }}";

            // Find all checked boxes and add them to the hidden form
            document.querySelectorAll('.item-checkbox:checked').forEach(box => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_items[]';
                input.value = box.value;
                form.appendChild(input);
            });

            // Append to body and submit
            document.body.appendChild(form);
            form.submit();
        });
    });
</script>

@endsection