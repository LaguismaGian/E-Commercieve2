<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Candle Glow Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-orange-400 text-white text-center py-6">
        <h1 class="text-3xl font-bold">Contact Candle Glow Shop</h1>
        <p class="mt-2 text-lg">We'd love to hear from you!</p>
    </header>

    <!-- Navigation - UPDATED with authentication logic -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
        </div>
        
        <!-- ========== AUTHENTICATION LOGIC ========== -->
        <!-- Shows different buttons based on login status -->
        @auth
            <div class="flex items-center space-x-4">
                <!-- Profile button - links to user profile page -->
                <a href="/profile" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 font-semibold transition duration-300">
                    👤 My Profile
                </a>
                <!-- Welcome message with user's name -->
                <span class="text-gray-700">Welcome, {{ Auth::user()->name }}! 👋</span>
                <!-- Logout form -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <!-- Show Sign In button for guests (not logged in) -->
            <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
        @endauth
        <!-- ========== END AUTHENTICATION LOGIC ========== -->
    </nav>

    <!-- Welcome Message for Logged-in Users -->
    @auth
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 mx-6 mt-4 rounded-lg">
        <p class="text-lg">
            🎉 Hi <strong>{{ Auth::user()->name }}</strong>! 
            We're here to help. Fill out the form below and we'll get back to you soon! ✨
        </p>
    </div>
    @endauth

    <!-- Contact Form -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
        
        <!-- Display success message if any -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Contact form - action will be added later when you create the controller -->
        <form action="" method="POST" class="space-y-4">   
                @csrf
            
            <div>
                <label class="block text-gray-700 mb-1" for="name">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       placeholder="Your Name" 
                       value="{{ old('name') }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 mb-1" for="email">Email</label>
                <!-- Pre-fill email if user is logged in -->
                <input type="email" 
                       id="email" 
                       name="email" 
                       placeholder="Your Email" 
                       value="{{ Auth::user()->email ?? old('email') }}"
                       class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 mb-1" for="message">Message</label>
                <textarea id="message" 
                          name="message" 
                          placeholder="Your Message" 
                          rows="5" 
                          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold transition duration-300">
                Send Message
            </button>
        </form>

        <div class="mt-8 text-gray-700">
            <p class="font-semibold">Or contact us at:</p>
            <p>📧 Email: info@candleglowshop.com</p>
            <p>📞 Phone: +63 912 345 6789</p>
            <p>📍 Address: 123 Candle Street, Manila, Philippines</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>