<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication - Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Candle Glow Shop</h1>
        <p class="mt-2 text-lg">Verify Your Identity</p>
    </header>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Two-Factor Authentication</h2>
            
            <div class="mb-4 text-sm text-gray-600 text-center">
                Please confirm access to your account by entering the authentication code from your authenticator app.
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Code Form -->
            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mb-4">
                    <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Authentication Code</label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           placeholder="000000"
                           autofocus>
                </div>

                <button type="submit" 
                        class="w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600 transition duration-300 font-semibold">
                    Verify & Login
                </button>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or use recovery code</span>
                    </div>
                </div>

                <!-- Recovery Code Form -->
                <form method="POST" action="{{ route('two-factor.login') }}" class="mt-6">
                    @csrf

                    <div class="mb-4">
                        <label for="recovery_code" class="block text-gray-700 text-sm font-bold mb-2">Recovery Code</label>
                        <input type="text" 
                               name="recovery_code" 
                               id="recovery_code" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="Enter recovery code">
                    </div>

                    <button type="submit" 
                            class="w-full bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 transition duration-300 font-semibold">
                        Use Recovery Code
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-orange-500 hover:text-orange-600">← Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-12">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>
</body>
</html>