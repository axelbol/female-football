<!-- Call to Action Section -->
<section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
            Ready to Share Your Journey?
        </h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Your story could inspire thousands of young girls to chase their football dreams. Join our community of incredible women making a difference.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-white text-emerald-600 px-8 py-3 rounded-lg text-lg font-medium hover:bg-gray-50 transition-colors">
                    Get Started
                </a>
            @endif
            <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-white/10 transition-colors">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex items-center justify-center space-x-2 mb-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                    <img src="{{ asset('img/logo/footer-logo.png') }}" alt="Capitanas Logo" class="w-36">
                </a>
            </div>
            <p class="text-gray-400 mb-4">
                Empowering women's voices in football, one story at a time.
            </p>
            <p class="text-sm text-gray-500">
                © 2025 Capitanas. All rights reserved.
            </p>
        </div>
    </div>
</footer>
