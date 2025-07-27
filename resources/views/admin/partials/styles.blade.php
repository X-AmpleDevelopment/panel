<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    background: {
                        DEFAULT: '#0B0B1E',
                        darker: '#070714',
                    },
                    accent: {
                        purple: '#9333EA',
                        blue: '#3B82F6',
                    },
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
            }
        }
    }
</script>
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    .glass-sidebar {
        background: rgba(11, 11, 30, 0.8);
        backdrop-filter: blur(10px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .nav-item {
        transition: all 0.3s ease;
    }

    .nav-item:hover, .nav-item.active {
        background: rgba(147, 51, 234, 0.1);
        border-left: 3px solid #9333EA;
    }

    .stats-card {
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px 0 rgba(147, 51, 234, 0.2);
    }

    .gradient-text {
        background: linear-gradient(to right, #9333EA, #3B82F6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .quick-action {
        transition: all 0.3s ease;
    }

    .quick-action:hover {
        background: rgba(147, 51, 234, 0.1);
        transform: translateY(-1px);
    }

    .search-overlay {
        background: rgba(11, 11, 30, 0.95);
        backdrop-filter: blur(5px);
    }

    .search-input {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(147, 51, 234, 0.3);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: rgba(147, 51, 234, 0.7);
        box-shadow: 0 0 0 2px rgba(147, 51, 234, 0.2);
    }

    .search-result {
        transition: all 0.2s ease;
    }

    .search-result:hover {
        background: rgba(147, 51, 234, 0.1);
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
</style>
