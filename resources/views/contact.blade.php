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
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-md flex justify-between items-center px-6 py-3">
        <div class="flex space-x-4">
            <a href="/" class="text-gray-800 font-semibold hover:text-orange-500">Home</a>
            <a href="/about" class="text-gray-800 font-semibold hover:text-orange-500">About</a>
            <a href="/shop" class="text-gray-800 font-semibold hover:text-orange-500">Shop</a>
            <a href="/contact" class="text-gray-800 font-semibold hover:text-orange-500">Contact</a>
        </div>
        <a href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Sign In</a>
    </nav>

    <!-- Contact Form -->
    <section class="max-w-4xl mx-auto my-12 p-6 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-1" for="name">Name</label>
                <input type="text" id="name" placeholder="Your Name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="email">Email</label>
                <input type="email" id="email" placeholder="Your Email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700 mb-1" for="message">Message</label>
                <textarea id="message" placeholder="Your Message" rows="5" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Send Message</button>
        </form>

        <div class="mt-8 text-gray-700">
            <p>Or contact us at:</p>
            <p>Email: info@candleglowshop.com</p>
            <p>Phone: +63 912 345 6789</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        &copy; 2026 Candle Glow Shop | All Rights Reserved
    </footer>

</body>
</html>