<div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-background transition-opacity duration-500">
    <div class="relative">
        <!-- Outer Ring -->
        <div class="absolute inset-0 animate-spin-slow">
            <svg class="w-20 h-20" viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color: var(--primary-color)" />
                        <stop offset="100%" style="stop-color: var(--secondary-color)" />
                    </linearGradient>
                </defs>
                <circle cx="50" cy="50" r="45" stroke="url(#gradient)" stroke-width="3" fill="none"
                        stroke-dasharray="180 300" class="transform origin-center" />
            </svg>
        </div>

        <!-- Inner Ring -->
        <div class="absolute inset-0 animate-spin">
            <svg class="w-20 h-20" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="35" stroke="var(--tertiary-color)" stroke-width="2" fill="none"
                        stroke-dasharray="140 200" class="transform origin-center" />
            </svg>
        </div>

        <!-- Logo/Icon -->
        <div class="absolute inset-0 flex items-center justify-center">
            <i class="fas fa-feather-alt text-2xl text-white animate-pulse"></i>
        </div>
    </div>
</div>

<style>
@keyframes spin-slow {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin-slow {
    animation: spin-slow 3s linear infinite;
}

#preloader {
    opacity: 1;
    visibility: visible;
}

#preloader.hidden {
    opacity: 0;
    visibility: hidden;
}

.preloader-blur {
    filter: blur(5px);
    transition: filter 0.3s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const content = document.getElementById('app-content');

    if ({{ \Pterodactyl\Models\MythicaluiTheme::getValue('enable_preloader', 'true') === 'true' ? 'true' : 'false' }}) {
        // Add blur to content
        content?.classList.add('preloader-blur');

        // Hide preloader after content loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                preloader?.classList.add('hidden');
                content?.classList.remove('preloader-blur');
            }, 500);
        });
    } else {
        preloader?.classList.add('hidden');
    }
});
</script>
