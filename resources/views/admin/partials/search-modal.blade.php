<div id="searchModal" class="fixed inset-0 z-50 flex items-start justify-center p-4 search-overlay hidden">
    <div class="w-full max-w-3xl mt-16">
        <div class="relative">
            <input type="text" id="searchInput"
                class="w-full h-12 sm:h-16 px-4 sm:px-6 py-2 sm:py-4 text-lg sm:text-xl bg-transparent search-input rounded-lg text-white placeholder-gray-400 focus:outline-none"
                placeholder="Search pages...">
            <button id="closeSearch"
                class="absolute top-2 sm:top-4 right-2 sm:right-4 text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-times text-xl sm:text-2xl"></i>
            </button>
        </div>
        <div id="searchResults" class="mt-4 max-h-[60vh] overflow-y-auto">
            <!-- Search results will be populated here -->
        </div>
    </div>
</div>
