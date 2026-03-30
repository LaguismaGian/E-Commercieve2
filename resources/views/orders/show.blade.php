<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Daily Essentials</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .text-brand-orange { color: #F47953; }
        .bg-brand-orange { background-color: #F47953; }
        
        /* Smooth entry animation for the popup card */
        @keyframes popup {
            0% { transform: scale(0.95) translateY(10px); opacity: 0; }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }
        .animate-popup { 
            animation: popup 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden"
      style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 24px 24px;">

    {{-- Decorative Background Blur for Depth --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-200/40 rounded-full blur-[80px] -z-10"></div>

    {{-- Popup Card --}}
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-8 md:p-10 text-center animate-popup border border-gray-100 relative">
        
        {{-- Top Accent Line --}}
        <div class="absolute top-0 left-0 w-full h-2 bg-brand-orange"></div>

        {{-- Aesthetic Success Icon --}}
        <div class="mx-auto w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-6 relative">
            <div class="absolute inset-0 bg-orange-100 rounded-full animate-ping opacity-20"></div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-brand-orange relative z-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        {{-- Headers --}}
        <h1 class="font-serif text-3xl font-bold text-slate-800 mb-2">Order Confirmed</h1>
        <p class="text-gray-500 text-sm mb-8">Thank you for choosing Daily Essentials.</p>

        {{-- Receipt Details Box --}}
        <div class="bg-slate-50 rounded-3xl p-6 mb-8 text-left border border-gray-100">
            <div class="flex justify-between items-end mb-5 pb-5 border-b border-gray-200 border-dashed">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1 ml-1">Order Number</p>
                    <p class="font-mono font-bold text-slate-800">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1 mr-1">Total Amount</p>
                    <p class="font-black text-brand-orange text-lg">₱{{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>

            {{-- Smart Status Message Based on Payment Method --}}
            @if($order->payment_method === 'gcash')
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-sm">⏳</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Awaiting Verification</p>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">We've received your GCash proof. We'll update your status shortly.</p>
                    </div>
                </div>
            @else
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-sm">📦</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Preparing for Dispatch</p>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Please prepare the exact cash amount for your delivery rider.</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-4">
            <a href="/shop" class="block w-full bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-brand-orange transition-all shadow-lg hover:shadow-orange-200 active:scale-95 text-sm tracking-wide">
                Return to Shop
            </a>
            <a href="{{ route('profile') ?? '#' }}" class="block w-full py-4 text-xs font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-slate-800 transition-colors">
                View My Dashboard
            </a>
        </div>

    </div>

</body>
</html>