<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const searchTrigger = document.getElementById('searchTrigger');
        const searchModal = document.getElementById('searchModal');
        const searchInput = document.getElementById('searchInput');
        const closeSearch = document.getElementById('closeSearch');
        const searchResults = document.getElementById('searchResults');
        const logoutButton = document.getElementById('logoutButton');

        // Toggle sidebar on mobile
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking outside
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Simulated search data (replace with actual data fetching logic)
        const searchData = [
            { title: 'Dashboard', keywords: ['dashboard', 'home'], description: 'Go to the dashboard', url: '/admin', icon: 'fa fa-home' },
            { title: 'Settings', keywords: ['settings', 'config', 'configuration'], description: 'Go to settings', url: '/admin/settings', icon: 'fa fa-cog' },
            { title: 'Advanced Settings', keywords: ['advanced settings', 'advanced'], description: 'Go to advanced settings', url: '/admin/settings/advanced', icon: 'fa fa-cogs' },
            { title: 'Mail Settings', keywords: ['mail settings', 'mail'], description: 'Go to mail settings', url: '/admin/settings/mail', icon: 'fa fa-envelope' },
            { title: 'API', keywords: ['api', 'application programming interface'], description: 'Go to the API page', url: '/admin/api', icon: 'fa fa-code' },
            { title: 'Databases', keywords: ['databases', 'db'], description: 'Go to the databases page', url: '/admin/databases', icon: 'fa fa-database' },
            { title: 'Locations', keywords: ['locations', 'location'], description: 'Go to the locations page', url: '/admin/locations', icon: 'fa fa-map-marker' },
            { title: 'Nodes', keywords: ['nodes', 'node'], description: 'Go to the nodes page', url: '/admin/nodes', icon: 'fa fa-sitemap' },
            { title: 'Servers', keywords: ['servers', 'server'], description: 'Go to the servers page', url: '/admin/servers', icon: 'fa fa-server' },
            { title: 'Users', keywords: ['users', 'user'], description: 'Go to the users page', url: '/admin/users', icon: 'fa fa-users' },
            { title: 'Mounts', keywords: ['mounts', 'mount'], description: 'Go to the mounts page', url: '/admin/mounts', icon: 'fa fa-hdd' },
            { title: 'Nests', keywords: ['nests', 'nest'], description: 'Go to the nests page', url: '/admin/nests', icon: 'fa fa-cubes' },
            { title: 'Create Nest', keywords: ['create nest', 'nest', 'add nest'], description: 'Create a new nest', url: '/admin/nests/new', icon: 'fa fa-cube' },
            { title: 'Create User', keywords: ['create user', 'user', 'add user'], description: 'Create a new user', url: '/admin/users/new', icon: 'fa fa-user-plus' },
            { title: 'Create Server', keywords: ['create server', 'server', 'add server'], description: 'Create a new server', url: '/admin/servers/new', icon: 'fa fa-server' },
            { title: 'Create Node', keywords: ['create node', 'node', 'add node'], description: 'Create a new node', url: '/admin/nodes/new', icon: 'fa fa-sitemap' },
            { title: 'Create Location', keywords: ['create location', 'location', 'add location'], description: 'Create a new location', url: '/admin/locations', icon: 'fa fa-map-marker' },
            { title: 'Theme Information', keywords: ['theme', 'release', 'version'], description: 'Theme released on 2024', url: '#', icon: 'fa fa-paint-brush', type: 'theme'
            },
            {
                title: "MythicalUI Editor",
                keywords: ['mythicalui', 'editor', 'mythicalui editor'],
                description: 'Go to the mythicalui editor',
                url: '/admin/mythicalsystems/mythicalui',
                icon: 'fa fa-code'
            }
            // Add more items as needed
        ];

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                searchModal.classList.add('hidden');
            }
        });

        searchTrigger.addEventListener('click', () => {
            searchModal.classList.remove('hidden');
            searchInput.focus();
        });

        closeSearch.addEventListener('click', () => {
            searchModal.classList.add('hidden');
        });

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            if (query.length > 0) {
                const filteredResults = searchData.filter(item =>
                    item.title.toLowerCase().includes(query) ||
                    item.keywords.some(keyword => keyword.toLowerCase().includes(query)) ||
                    item.description.toLowerCase().includes(query)
                );
                displaySearchResults(filteredResults);
            } else {
                searchResults.innerHTML = '';
            }
        });

        function displaySearchResults(results) {
            searchResults.innerHTML = '';
            if (results.length > 0) {
                results.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'p-4 hover:bg-white/5 transition-colors cursor-pointer search-result';

                    // Special handling for theme type
                    if (item.type === 'theme') {
                        div.innerHTML = `
                            <div class="flex items-center space-x-4">
                                <div class="p-2 bg-accent-purple/10 rounded-lg">
                                    <i class="${item.icon} text-accent-purple"></i>
                                </div>
                                <div>
                                    <div class="text-gray-200 font-medium">${item.title}</div>
                                    <div class="text-sm text-gray-400">${item.description}</div>
                                </div>
                            </div>
                        `;
                    } else {
                        div.innerHTML = `
                            <a href="${item.url}" class="flex items-center space-x-4">
                                <div class="p-2 bg-accent-purple/10 rounded-lg">
                                    <i class="${item.icon} text-accent-purple"></i>
                                </div>
                                <div>
                                    <div class="text-gray-200 font-medium">${item.title}</div>
                                    <div class="text-sm text-gray-400">${item.description}</div>
                                </div>
                            </a>
                        `;
                    }
                    searchResults.appendChild(div);
                });
            } else {
                searchResults.innerHTML = `
                    <div class="p-8 text-center">
                        <div class="p-3 bg-gray-800/50 inline-block rounded-full mb-4">
                            <i class="fas fa-search text-gray-400 text-xl"></i>
                        </div>
                        <div class="text-gray-400">No results found for "${searchInput.value}"</div>
                    </div>
                `;
            }
        }

        // Add keyboard navigation
        let selectedIndex = -1;
        const KEY_UP = 38;
        const KEY_DOWN = 40;
        const KEY_ENTER = 13;

        searchInput.addEventListener('keydown', function(e) {
            const results = searchResults.querySelectorAll('.search-result');

            if (results.length === 0) return;

            if (e.keyCode === KEY_UP) {
                e.preventDefault();
                selectedIndex = Math.max(selectedIndex - 1, 0);
                highlightResult(results);
            } else if (e.keyCode === KEY_DOWN) {
                e.preventDefault();
                selectedIndex = Math.min(selectedIndex + 1, results.length - 1);
                highlightResult(results);
            } else if (e.keyCode === KEY_ENTER && selectedIndex > -1) {
                e.preventDefault();
                results[selectedIndex].querySelector('a').click();
            }
        });

        function highlightResult(results) {
            results.forEach((result, index) => {
                if (index === selectedIndex) {
                    result.classList.add('bg-white/5');
                } else {
                    result.classList.remove('bg-white/5');
                }
            });
        }

        // Reset selection when input changes
        searchInput.addEventListener('input', function() {
            selectedIndex = -1;
        });

        // Add click handlers for search results
        searchResults.addEventListener('click', function(e) {
            const searchResult = e.target.closest('.search-result');
            if (searchResult) {
                const link = searchResult.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            }
        });

        // Add hover effect to reset keyboard selection
        searchResults.addEventListener('mousemove', function() {
            selectedIndex = -1;
            const results = searchResults.querySelectorAll('.search-result');
            results.forEach(result => result.classList.remove('bg-white/5'));
        });

        // Close search modal when clicking outside
        searchModal.addEventListener('click', function (event) {
            if (event.target === searchModal) {
                searchModal.classList.add('hidden');
            }
        });

        logoutButton.addEventListener('click', function (event) {
            event.preventDefault();
            if (confirm('Do you want to log out?')) {
                fetch('{{ route('auth.logout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                }).then(() => {
                    window.location.href = '{{route('auth.login')}}';
                });
            }
        });
    });
</script>

