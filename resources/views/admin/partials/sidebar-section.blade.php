@php use Illuminate\Support\Str; @endphp

<div>
    <h2 class="text-xs uppercase tracking-wider text-gray-400 mb-3">{{ $title }}</h2>
    <nav class="space-y-1">
        @foreach ($items as $item)
            @php
                $route = $item['route'] ?? '#';
                $isExternal = Str::startsWith($route, ['http://', 'https://']);
                $shouldShow = $isExternal || Route::has($route);
                $url = $isExternal ? $route : ($shouldShow ? route($route) : '#');
                $isActive = !$isExternal && Route::currentRouteName() === $route;
            @endphp

            @if ($shouldShow)
                <a href="{{ $url }}"
                   class="nav-item flex items-center space-x-3 px-4 py-2 rounded-lg {{ $isActive ? 'active' : '' }}"
                   @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                    <i class="fas {{ $item['icon'] ?? '' }} text-gray-400"></i>
                    <span>{{ $item['title'] ?? 'Untitled' }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</div>
