<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MythicalSystems') }} - @yield('title')</title>
    @include('layouts.scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/micromodal@0.4.10/dist/micromodal.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('logo_url', 'https://github.com/mythicalltd.png') }}">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: {
                            DEFAULT: '{{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_color', '#0B0B1E') }}',
                            darker: '{{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_darker', '#070714') }}',
                        },
                        accent: {
                            purple: '{{ \Pterodactyl\Models\MythicaluiTheme::getValue('primary_color', '#9333EA') }}',
                            blue: '{{ \Pterodactyl\Models\MythicaluiTheme::getValue('secondary_color', '#3B82F6') }}',
                            pink: '{{ \Pterodactyl\Models\MythicaluiTheme::getValue('tertiary_color', '#EC4899') }}',
                        },
                    },
                    fontFamily: {
                        sans: ['{{ \Pterodactyl\Models\MythicaluiTheme::getValue('font_family', 'Inter') }}', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Dynamic Theme Styles */
        :root {
            --primary-color: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('primary_color', '#9333EA') }};
            --secondary-color: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('secondary_color', '#3B82F6') }};
            --tertiary-color: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('tertiary_color', '#EC4899') }};
            --background-color: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_color', '#0B0B1E') }};
            --background-darker: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_darker', '#070714') }};
            --animation-speed: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('animation_speed', 'duration-300') }};
            --base-font-size: {{ \Pterodactyl\Models\MythicaluiTheme::getValue('base_font_size', '16px') }};
        }

        body {
            font-size: var(--base-font-size);
            background-color: var(--background-color);
            background-image: url('{{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_url', '') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
        }

        .accent-purple {
            color: var(--primary-color) !important;
        }

        .bg-accent-purple {
            background-color: var(--primary-color) !important;
        }

        .border-accent-purple {
            border-color: var(--primary-color) !important;
        }

        .hover\:bg-accent-purple:hover {
            background-color: var(--primary-color) !important;
        }

        .focus\:border-accent-purple:focus {
            border-color: var(--primary-color) !important;
        }

        /* Animation Classes */
        .transition-all {
            transition-duration:
                {{ str_replace('duration-', '', \Pterodactyl\Models\MythicaluiTheme::getValue('animation_speed', 'duration-300')) }}
                ms;
        }

        /* Select2 Dark Theme Styles */
        .select2-container--dark {
            width: 100% !important;
        }

        .select2-container {
            z-index: 9999;
        }

        /* Select2 Dark Theme Styles */
        .select2-container--dark {
            width: 100% !important;
        }

        .select2-container--dark .select2-selection--single {
            background: color-mix(in srgb, var(--background-darker) 95%, white) !important;
            border-color: color-mix(in srgb, white 10%, transparent) !important;
        }

        .select2-container--dark .select2-selection--single .select2-selection__rendered {
            color: white !important;
            line-height: 42px !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .select2-container--dark .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-container--dark .select2-dropdown {
            background-color: rgb(17, 24, 39) !important;
            border-color: rgb(55, 65, 81) !important;
            border-radius: 0.5rem !important;
            margin-top: 4px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .select2-container--dark .select2-results__option {
            color: white !important;
            padding: 8px 12px !important;
        }

        .select2-container--dark .select2-results__option--highlighted[aria-selected] {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .select2-container--dark .select2-results__option[aria-selected=true] {
            background-color: color-mix(in srgb, var(--primary-color) 50%, transparent) !important;
        }

        .select2-container--dark .select2-search__field {
            background-color: rgb(17, 24, 39) !important;
            color: white !important;
            border-color: rgb(55, 65, 81) !important;
            border-radius: 0.375rem !important;
            padding: 6px 10px !important;
        }

        .select2-container--dark .select2-results__group {
            color: rgb(156, 163, 175) !important;
            font-size: 0.875rem !important;
            padding: 6px 12px !important;
            font-weight: 500 !important;
        }

        .glass-card {
            background: color-mix(in srgb, var(--background-color) 97%, white);
            backdrop-filter: blur(10px);
            border: 1px solid color-mix(in srgb, white 5%, transparent);
            box-shadow: 0 8px 32px 0 color-mix(in srgb, black 37%, transparent);
        }

        .glass-sidebar {
            background: color-mix(in srgb, var(--background-color) 80%, transparent);
            backdrop-filter: blur(10px);
            border-right: 1px solid color-mix(in srgb, white 5%, transparent);
        }

        .nav-item {
            transition: all 0.3s ease;
        }

        .nav-item:hover,
        .nav-item.active {
            background: color-mix(in srgb, var(--primary-color) 10%, transparent);
            border-left: 3px solid var(--primary-color);
            box-shadow: inset 0 0 15px color-mix(in srgb, var(--primary-color) 5%, transparent);
        }

        .stats-card {
            transition: all var(--animation-speed) ease;
            background: color-mix(in srgb, var(--background-darker) 95%, white);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px 0 color-mix(in srgb, var(--primary-color) 20%, transparent);
            background: color-mix(in srgb, var(--background-darker) 90%, white);
        }

        .gradient-text {
            background: linear-gradient(135deg,
                var(--primary-color),
                var(--secondary-color),
                var(--tertiary-color)
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .quick-action {
            transition: all 0.3s ease;
        }

        .quick-action:hover {
            background: rgba(var(--primary-color), 0.1);
            transform: translateY(-1px);
        }

        .search-overlay {
            background: rgba(11, 11, 30, 0.95);
            backdrop-filter: blur(5px);
        }

        .search-input {
            background: color-mix(in srgb, var(--background-darker) 95%, white);
            border: 2px solid color-mix(in srgb, var(--primary-color) 30%, transparent);
            transition: all var(--animation-speed) ease;
        }

        .search-input:focus {
            background: color-mix(in srgb, var(--background-darker) 90%, white);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color) 20%, transparent);
        }

        .search-result {
            transition: all 0.2s ease;
        }

        .search-result:hover {
            background: rgba(var(--primary-color), 0.1);
        }

        @media (max-width: 1024px) {
            .glass-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                z-index: 50;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--background-darker);
        }

        ::-webkit-scrollbar-thumb {
            background: color-mix(in srgb, var(--primary-color) 30%, transparent);
            border: 2px solid var(--background-darker);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: color-mix(in srgb, var(--primary-color) 50%, transparent);
        }

        /* Enhanced Button Effects */
        .btn-primary {
            background: var(--primary-color);
            transition: all var(--animation-speed) ease;
        }

        .btn-primary:hover {
            background: color-mix(in srgb, var(--primary-color) 80%, white);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px color-mix(in srgb, var(--primary-color) 30%, transparent);
        }

        /* Modal Backdrop */
        .modal-backdrop {
            background: color-mix(in srgb, var(--background-color) 80%, transparent);
            backdrop-filter: blur(5px);
        }

        /* Preloader Integration */
        #app-content {
            opacity: 0;
            animation: fadeIn 0.3s ease-in forwards;
            animation-delay: 0.5s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>

    @section('scripts')

    {!! Theme::css('vendor/animate/animate.min.css?t={cache-version}') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    @show

    <!-- Add in the head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
</head>

<body class="font-sans text-gray-100 bg-background min-h-screen">
    @if (\Pterodactyl\Models\MythicaluiTheme::getValue('enable_preloader', 'true') === 'true')
        @include('admin.partials.preloader')
    @endif
    @if (\Pterodactyl\Models\MythicaluiTheme::getValue('enable_particles', 'true') === 'true')
        @include('admin.components.particles')
    @endif
    <div id="app-content" class="flex min-h-screen">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="flex-1 min-h-screen lg:ml-64">
            <!-- Top Navigation -->
            <div class="sticky top-0 z-40">
                @include('admin.partials.navbar')
            </div>

            <!-- Page Content -->
            <div class="p-4 lg:p-8">
                @include('admin.partials.alerts')
                <div class="rounded-lg p-4 lg:p-6 min-h-[calc(100vh-8rem)] glass-card">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>


    @section('footer-scripts')
    <script src="/js/keyboard.polyfill.js" type="application/javascript"></script>
    <script>keyboardeventKeyPolyfill.polyfill();</script>

    {!! Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') !!}
    {!! Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}') !!}
    {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') !!}
    {!! Theme::js('js/admin/functions.js?t={cache-version}') !!}
    <script src="/js/autocomplete.js" type="application/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"
        integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(Auth::user()->root_admin)
        <script>
            $('#logoutButton').on('click', function (event) {
                event.preventDefault();

                var that = this;
                Swal.fire({
                    title: 'Do you want to log out?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d9534f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Log out'
                }, function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('auth.logout') }}',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }, complete: function () {
                            window.location.href = '{{route('auth.login')}}';
                        }
                    });
                });
            });
        </script>
    @endif

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    @show
    @include('admin.partials.search-modal')
    @include('admin.partials.scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/micromodal@0.4.10/dist/micromodal.min.js"></script>
</body>

</html>
