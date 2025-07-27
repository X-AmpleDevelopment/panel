<aside id="sidebar"
    class="glass-sidebar w-64 fixed h-screen flex flex-col transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 z-50">
    <!-- Logo/Header Section - Fixed -->
    <div class="p-6">
        <div class="flex items-center space-x-3 mb-8">
            <div class="w-10 h-10 bg-accent-purple/10 rounded-xl flex items-center justify-center shadow-lg hover:scale-105 transition-all">
                <img src="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('logo_url', 'https://github.com/mythicalltd.png') }}"
                     alt="MythicalUI Logo"
                     class="w-8 h-8 object-contain rounded-lg"
                >
            </div>
            <h1 class="text-xl font-bold text-white">{{config('app.name', 'MythicalUI')}}</h1>
        </div>

        <!-- Scrollable Menu Section -->
        <div class="space-y-6 overflow-y-auto custom-scrollbar" style="max-height: calc(100vh - 180px);">
            @include('admin.partials.sidebar-section', [
    'title' => 'XD | OVERVIEW',
    'items' => [
        ['title' => 'Dashboard', 'icon' => 'fa-tachometer-alt', 'route' => 'admin.index'],
        ['title' => 'Statistics', 'icon' => 'fa-chart-line', 'route' => 'admin.mythicalsystems.stats'],

    ]
])

            @include('admin.partials.sidebar-section', [
    'title' => 'XD | SERVER MANAGEMENT',
    'items' => [
        ['title' => 'Servers', 'icon' => 'fa-server', 'route' => 'admin.servers'],
        ['title' => 'Nodes', 'icon' => 'fa-network-wired', 'route' => 'admin.nodes'],
        ['title' => 'Locations', 'icon' => 'fa-map-marker-alt', 'route' => 'admin.locations'],
    ]
])

            @include('admin.partials.sidebar-section', [
    'title' => 'XD | USER MANAGEMENT',
    'items' => [
        ['title' => 'Users', 'icon' => 'fa-users', 'route' => 'admin.users'],
    ]
])

            @include('admin.partials.sidebar-section', [
    'title' => 'XD | CONFIGURATION',
    'items' => [    
        [
            'title' => 'Databases',
            'icon' => 'fa-database',
            'route' => 'admin.databases',
        ],
        ['title' => 'Mounts', 'icon' => 'fa-hdd', 'route' => 'admin.mounts'],
        ['title' => 'Nests', 'icon' => 'fa-layer-group', 'route' => 'admin.nests'],
        ['title' => 'Firewall', 'icon' => 'fa-shield-alt', 'route' => 'admin.firewall'],
    ]
])

            @include('admin.partials.sidebar-section', [
    'title' => 'XD | Health & Logs',
    'items' => [
        ['title' => 'Health', 'icon' => 'fa-heartbeat', 'route' => 'admin.mythicalsystems.health'],
        ['title' => 'Logs', 'icon' => 'fa-file-alt', 'route' => 'admin.mythicalsystems.logs'],
    ]
])
    @include('admin.partials.sidebar-section', [
        'title' => 'API',
        'items' => array_merge(
            [['title' => 'API Keys', 'icon' => 'fa-key', 'route' => 'admin.api.index']],
            \Pterodactyl\Models\MythicaluiTheme::getValue('enable_api_tester', 'true') === 'true'
                ? [['title' => 'API Tester', 'icon' => 'fa-code', 'route' => 'admin.mythicalsystems.api-tester']]
                : []
        )
    ])
@include('admin.partials.sidebar-section', [
    'title' => 'XD | Sites',
    'items' => [
        ['title' => 'X-Ample UI', 'icon' => 'fa-paint-brush', 'route' => 'admin.mythicalsystems.mythicalui'],
        [
            'title' => 'Support Bot',
            'icon' => 'fa-paint-brush',
            'route' => 'https://support.x-ampledevelopment.co.uk'
        ],
	[
            'title' => 'Main Website',
            'icon' => 'fa-paint-brush',
            'route' => 'https://x-ampledevelopment.co.uk'
        ],
	[
            'title' => 'AdvertHub',
            'icon' => 'fa-paint-brush',
            'route' => 'https://discord.x-ampledevelopment.co.uk'
        ],


    ]
])



        </div>
    </div>

</aside>

<div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

<style>
    /* Custom Scrollbar Styles */
    .custom-scrollbar::-webkit-scrollbar {
        width: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 1px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(
            to bottom,
            rgba(var(--primary-color-rgb), 0.3),
            rgba(var(--secondary-color-rgb), 0.3)
        );
        border-radius: 1px;
        transition: all 0.3s;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(
            to bottom,
            rgba(var(--primary-color-rgb), 0.5),
            rgba(var(--secondary-color-rgb), 0.5)
        );
    }

    /* Firefox Scrollbar */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(var(--primary-color-rgb), 0.3) transparent;
    }

    /* Hide scrollbar when not hovering */
    .custom-scrollbar {
        scrollbar-width: none;
    }

    .custom-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Show scrollbar on hover */
    .custom-scrollbar:hover::-webkit-scrollbar {
        display: block;
    }

    .custom-scrollbar:hover {
        scrollbar-width: thin;
    }

    /* Smooth scrolling */
    .custom-scrollbar {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }
</style>

<script>
    // Extract RGB values from CSS variables for the gradient
    document.addEventListener('DOMContentLoaded', function() {
        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        const primaryColor = getComputedStyle(document.documentElement)
            .getPropertyValue('--primary-color').trim();
        const secondaryColor = getComputedStyle(document.documentElement)
            .getPropertyValue('--secondary-color').trim();

        const primaryRgb = hexToRgb(primaryColor);
        const secondaryRgb = hexToRgb(secondaryColor);

        if (primaryRgb && secondaryRgb) {
            document.documentElement.style.setProperty(
                '--primary-color-rgb',
                `${primaryRgb.r}, ${primaryRgb.g}, ${primaryRgb.b}`
            );
            document.documentElement.style.setProperty(
                '--secondary-color-rgb',
                `${secondaryRgb.r}, ${secondaryRgb.g}, ${secondaryRgb.b}`
            );
        }
    });
</script>
