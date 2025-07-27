@extends('layouts.admin')

@section('title')
Nodes
@endsection

@section('scripts')
@parent
{!! Theme::css('vendor/fontawesome/animation.min.css') !!}
@endsection


@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-100">
            <div class="flex items-center space-x-4">
                <div class="p-2 bg-accent-purple/10 rounded-lg">
                    <i class="fas fa-server text-accent-purple"></i>
                </div>
                <div>
                    Nodes
                    <small class="block mt-1 text-base font-normal text-gray-400">All nodes available on the
                        system.</small>
                </div>
            </div>
        </h1>
    </div>
    <div class="flex items-center space-x-3">
        <form action="{{ route('admin.nodes') }}" method="GET">
            <div class="relative">
                <input type="text" name="filter[name]" value="{{ request()->input('filter.name') }}"
                    class="w-64 bg-background/50 text-white rounded-xl py-2.5 pl-11 pr-4 border border-gray-700 focus:border-accent-purple focus:ring-1 focus:ring-accent-purple focus:ring-opacity-50 transition-all duration-300"
                    placeholder="Search nodes...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-500"></i>
                </div>
            </div>
        </form>
        <a href="{{ route('admin.nodes.new') }}"
            class="flex items-center px-4 py-2 bg-accent-purple text-white rounded-xl hover:bg-accent-purple/80 transition-all duration-300 group">
            <i class="fas fa-plus-circle mr-2 group-hover:scale-110 transition-transform duration-300"></i>
            Create Node
        </a>
    </div>
</div>
<div class="grid gap-6">
    @foreach ($nodes as $node)
        <div
            class="glass-card rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-accent-purple/10 border border-gray-700/50">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-xl bg-accent-purple/10 flex items-center justify-center">
                                <i class="fas fa-server text-accent-purple text-xl"></i>
                            </div>
                            <div class="absolute -bottom-1 -right-1 flex items-center space-x-1" data-action="ping"
                                data-secret="{{ $node->getDecryptedKey() }}"
                                data-location="{{ $node->scheme }}://{{ $node->fqdn }}:{{ $node->daemonListen }}/api/system">
                                <div class="status-indicator">
                                    <i class="fas fa-circle-notch fa-spin text-gray-500"></i>
                                    <span class="status-version text-xs ml-1 hidden"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.nodes.view', $node->id) }}"
                                    class="text-lg font-semibold text-gray-100 hover:text-accent-purple transition-colors">
                                    {{ $node->name }}
                                </a>
                                @if($node->maintenance_mode)
                                    <span class="px-2.5 py-1 text-xs bg-yellow-500/10 text-yellow-500 rounded-full">
                                        <i class="fas fa-wrench mr-1"></i>
                                        Maintenance
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center mt-1 space-x-4 text-sm text-gray-400">
                                <span>
                                    <i class="fas fa-map-marker-alt mr-1.5"></i>
                                    {{ $node->location->short }}
                                </span>
                                <span>
                                    <i class="fas fa-memory mr-1.5"></i>
                                    {{ $node->memory }} MiB
                                </span>
                                <span>
                                    <i class="fas fa-hdd mr-1.5"></i>
                                    {{ $node->disk }} MiB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex flex-col items-center">
                            <span class="text-2xl font-bold text-gray-100">{{ $node->servers_count }}</span>
                            <span class="text-xs text-gray-400 mt-1">Servers</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex flex-col items-center">
                                <i class="fa fa-{{ ($node->scheme === 'https') ? 'lock' : 'unlock' }} text-xl mb-1"
                                    class="{{ ($node->scheme === 'https') ? 'text-emerald-500' : 'text-red-500' }}"></i>
                                <span class="text-xs text-gray-400">SSL</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fa fa-{{ ($node->public) ? 'eye' : 'eye-slash' }} text-xl mb-1 text-gray-300"></i>
                                <span class="text-xs text-gray-400">Visibility</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($nodes->hasPages())
    <div class="mt-6">
        <div class="flex justify-center">
            {!! $nodes->appends(['query' => Request::input('query')])->render() !!}
        </div>
    </div>
@endif
@endsection

@section('footer-scripts')
@parent
<style>
.status-indicator {
    display: flex;
    align-items: center;
    padding: 2px 6px;
    border-radius: 9999px;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(4px);
}

.status-version {
    color: #9CA3AF;
    font-size: 0.7rem;
}
</style>
<script>
(function pingNodes() {
    $('div[data-action="ping"]').each(function(i, element) {
        const $element = $(element);
        const $indicator = $element.find('.status-indicator i');
        const $version = $element.find('.status-version');

        $.ajax({
            type: 'GET',
            url: $element.data('location'),
            headers: {
                'Authorization': 'Bearer ' + $element.data('secret'),
            },
            timeout: 5000
        }).done(function(data) {
            $indicator
                .removeClass('fa-circle-notch fa-spin text-gray-500')
                .addClass('fa-circle text-emerald-500');
            $version
                .removeClass('hidden');
        }).fail(function(error) {
            $indicator
                .removeClass('fa-circle-notch fa-spin text-gray-500')
                .addClass('fa-circle text-red-500');
            $version
                .removeClass('hidden');
        });
    }).promise().done(function() {
        setTimeout(pingNodes, 10000);
    });
})();
</script>
@endsection
