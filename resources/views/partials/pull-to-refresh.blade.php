<!-- Pull to Refresh Component -->
<div id="pull-refresh-container" class="md:hidden">
    <!-- Pull to Refresh Indicator -->
    <div id="pull-refresh-indicator" class="fixed top-16 left-0 right-0 z-30 bg-emerald-50 dark:bg-emerald-900/20 transform -translate-y-full transition-transform duration-300 ease-out">
        <div class="flex items-center justify-center py-4">
            <div class="flex items-center space-x-3 text-emerald-600 dark:text-emerald-400">
                <svg id="pull-refresh-icon" class="w-5 h-5 animate-spin hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <svg id="pull-arrow-icon" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
                <span id="pull-refresh-text" class="text-sm font-medium">Desliza para actualizar</span>
            </div>
        </div>
    </div>
</div>

<script>
class PullToRefresh {
    constructor() {
        this.container = document.getElementById('pull-refresh-container');
        this.indicator = document.getElementById('pull-refresh-indicator');
        this.icon = document.getElementById('pull-refresh-icon');
        this.arrowIcon = document.getElementById('pull-arrow-icon');
        this.text = document.getElementById('pull-refresh-text');

        this.startY = 0;
        this.currentY = 0;
        this.pulling = false;
        this.threshold = 80;
        this.maxPull = 120;
        this.isRefreshing = false;

        this.init();
    }

    init() {
        if (!this.container) return;

        // Only enable on mobile
        if (window.innerWidth >= 768) return;

        document.addEventListener('touchstart', this.onTouchStart.bind(this), { passive: true });
        document.addEventListener('touchmove', this.onTouchMove.bind(this), { passive: false });
        document.addEventListener('touchend', this.onTouchEnd.bind(this), { passive: true });

        // Disable on scroll containers that aren't at top
        document.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                this.reset();
            }
        });
    }

    onTouchStart(e) {
        if (this.isRefreshing || window.scrollY > 0) return;

        this.startY = e.touches[0].clientY;
        this.pulling = true;
    }

    onTouchMove(e) {
        if (!this.pulling || this.isRefreshing || window.scrollY > 0) return;

        this.currentY = e.touches[0].clientY;
        const pullDistance = Math.max(0, this.currentY - this.startY);

        if (pullDistance > 10) { // Start showing indicator after 10px
            e.preventDefault(); // Prevent default scrolling

            const progress = Math.min(pullDistance / this.threshold, 1);
            const displayDistance = Math.min(pullDistance, this.maxPull);

            // Show and animate indicator
            this.indicator.style.transform = `translateY(${displayDistance - 60}px)`;

            // Update arrow rotation based on progress
            if (progress >= 1) {
                this.arrowIcon.style.transform = 'rotate(180deg)';
                this.text.textContent = 'Suelta para actualizar';
            } else {
                this.arrowIcon.style.transform = `rotate(${progress * 180}deg)`;
                this.text.textContent = 'Desliza para actualizar';
            }
        }
    }

    onTouchEnd(e) {
        if (!this.pulling || this.isRefreshing) return;

        const pullDistance = Math.max(0, this.currentY - this.startY);

        if (pullDistance >= this.threshold) {
            this.refresh();
        } else {
            this.reset();
        }

        this.pulling = false;
    }

    async refresh() {
        if (this.isRefreshing) return;

        this.isRefreshing = true;

        // Show loading state
        this.indicator.style.transform = 'translateY(0)';
        this.arrowIcon.classList.add('hidden');
        this.icon.classList.remove('hidden');
        this.text.textContent = 'Actualizando...';

        try {
            // Add haptic feedback if available
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }

            // Simulate refresh (reload page or fetch new data)
            await new Promise(resolve => setTimeout(resolve, 1000));

            // For now, just reload the page
            // In a real app, you might fetch new data via AJAX
            window.location.reload();

        } catch (error) {
            console.error('Refresh failed:', error);
            this.reset();
        }
    }

    reset() {
        this.isRefreshing = false;
        this.pulling = false;

        // Hide indicator
        this.indicator.style.transform = 'translateY(-100%)';

        // Reset icons and text
        setTimeout(() => {
            this.arrowIcon.classList.remove('hidden');
            this.icon.classList.add('hidden');
            this.arrowIcon.style.transform = 'rotate(0deg)';
            this.text.textContent = 'Desliza para actualizar';
        }, 300);
    }
}

// Initialize pull-to-refresh when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PullToRefresh();
});

// Reinitialize on window resize
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        // Disable pull-to-refresh on desktop
        const indicator = document.getElementById('pull-refresh-indicator');
        if (indicator) {
            indicator.style.transform = 'translateY(-100%)';
        }
    }
});
</script>