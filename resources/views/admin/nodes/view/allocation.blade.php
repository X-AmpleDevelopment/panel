@extends('layouts.admin')

@section('title')
    {{ $node->name }}: Allocations
@endsection

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-2 bg-accent-purple/10 rounded-lg">
                            <i class="fas fa-server text-accent-purple"></i>
                        </div>
                        <div>
                            {{ $node->name }}
                            <small class="block mt-1 text-base font-normal text-gray-400">Manage IP addresses and ports for this node</small>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.nodes') }}"
                   class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Back to Nodes
                </a>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex items-center space-x-2 mt-8 border-b border-gray-700">
            <a href="{{ route('admin.nodes.view', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Overview
            </a>
            <a href="{{ route('admin.nodes.view.settings', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Settings
            </a>
            <a href="{{ route('admin.nodes.view.configuration', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Configuration
            </a>
            <a href="{{ route('admin.nodes.view.allocation', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium rounded-t-lg bg-accent-purple text-white border-b-2 border-accent-purple">
                Allocation
            </a>
            <a href="{{ route('admin.nodes.view.servers', $node->id) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Servers
            </a>
        </div>
    </div>
    @if(\Pterodactyl\Models\MythicaluiTheme::getValue('enable_allocation_helper', 'true') === 'true')
    <div class="mb-2 lg:col-span-3">
        @include('admin.components.allocation-helper')
    </div>
    @endif
    <div class="grid grid-cols-3 gap-8">
        <!-- Existing Allocations -->
        <div class="col-span-2">
            <div class="glass-card rounded-lg overflow-hidden">
                <div class="p-5 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold gradient-text">Existing Allocations</h3>
                        <div class="flex items-center space-x-4">
                            <form action="{{ route('admin.nodes.view.allocation.removeBlock', $node->id) }}"
                                  method="POST"
                                  class="flex items-center space-x-2">
                                {!! csrf_field() !!}
                                <div class="relative">
                                    <select name="ip"
                                            class="pr-8 pl-3 py-1.5 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50 appearance-none cursor-pointer">
                                        @foreach($allocations as $allocation)
                                            <option value="{{ $allocation->ip }}">{{ $allocation->ip }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="px-3 py-1.5 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    Delete IP Block
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center justify-between mb-4">
                        <!-- Mass Selection Controls -->
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox"
                                       class="w-4 h-4 rounded border-gray-600 bg-background text-accent-purple focus:ring-accent-purple"
                                       data-action="selectAll"
                                       id="selectAllCheckbox">
                                <label for="selectAllCheckbox" class="text-sm text-gray-400">Select All</label>
                            </div>
                            <button type="button"
                                    id="mass_actions"
                                    data-action="selective-deletion"
                                    class="px-3 py-1.5 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors disabled:opacity-50 disabled:cursor-not-allowed hidden">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Delete Selected
                            </button>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-background/50">
                                <tr>
                                    <th class="p-3 w-10"></th>
                                    <th class="p-3">IP Address</th>
                                    <th class="p-3">IP Alias</th>
                                    <th class="p-3">Port</th>
                                    <th class="p-3">Assigned To</th>
                                    <th class="p-3 w-20">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($node->allocations as $allocation)
                                    <tr class="border-b border-gray-700 last:border-0 hover:bg-gray-700/10">
                                        <td class="p-3">
                                            @if(is_null($allocation->server_id))
                                                <input type="checkbox"
                                                       class="select-file w-4 h-4 rounded border-gray-600 bg-background text-accent-purple focus:ring-accent-purple"
                                                       data-action="addSelection"
                                                       data-allocation-id="{{ $allocation->id }}">
                                            @else
                                                <input type="checkbox"
                                                       disabled
                                                       class="select-file w-4 h-4 rounded border-gray-600 bg-background opacity-50 cursor-not-allowed">
                                            @endif
                                        </td>
                                        <td class="p-3" data-identifier="ip">{{ $allocation->ip }}</td>
                                        <td class="p-3">
                                            <div class="relative">
                                                <input type="text"
                                                       value="{{ $allocation->ip_alias }}"
                                                       data-action="set-alias"
                                                       data-id="{{ $allocation->id }}"
                                                       class="w-full px-3 py-1.5 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                                       placeholder="none" />
                                                <span class="input-loader absolute right-2 top-1/2 -translate-y-1/2 hidden">
                                                    <i class="fas fa-sync fa-spin text-accent-purple"></i>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-3" data-identifier="port">{{ $allocation->port }}</td>
                                        <td class="p-3">
                                            @if(! is_null($allocation->server))
                                                <a href="{{ route('admin.servers.view', $allocation->server_id) }}"
                                                   class="text-accent-blue hover:text-accent-purple transition-colors">
                                                    {{ $allocation->server->name }}
                                                </a>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            @if(is_null($allocation->server_id))
                                                <button data-action="deallocate"
                                                        data-id="{{ $allocation->id }}"
                                                        class="px-2 py-1 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500/20 transition-colors">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($node->allocations->hasPages())
                        <div class="mt-4 flex items-center justify-center space-x-2">
                            @foreach ($node->allocations->getUrlRange(1, $node->allocations->lastPage()) as $page => $url)
                                <a href="{{ $url }}"
                                   class="px-3 py-1.5 rounded-lg {{ $page == $node->allocations->currentPage() ? 'bg-accent-purple text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} transition-colors">
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- New Allocations -->
        <div>
            <form action="{{ route('admin.nodes.view.allocation', $node->id) }}" method="POST">
                <div class="glass-card rounded-lg overflow-hidden">
                    <div class="p-5 border-b border-gray-700">
                        <h3 class="text-xl font-semibold gradient-text">Assign New Allocations</h3>
                    </div>
                    <div class="p-5 space-y-6">
                        <!-- IP Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">IP Address</label>
                            <div class="relative">
                                <input type="text"
                                       name="allocation_ip"
                                       list="allocation_ips"
                                       class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                       placeholder="Enter IP address">
                                <datalist id="allocation_ips">
                                    @foreach($allocations as $allocation)
                                        <option value="{{ $allocation->ip }}">
                                    @endforeach
                                </datalist>

                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">Select an IP address to assign ports to.</p>
                        </div>

                        <!-- IP Alias -->
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">IP Alias</label>
                            <input type="text"
                                   name="allocation_alias"
                                   class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                   placeholder="alias" />
                            <p class="mt-1 text-xs text-gray-400">Optional: Set a default alias for these allocations.</p>
                        </div>

                        <!-- Ports -->
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Ports</label>
                            <input type="text"
                                   name="allocation_ports[]"
                                   class="w-full px-4 py-2 bg-background text-white rounded-lg border border-gray-700 focus:border-accent-purple focus:ring focus:ring-accent-purple focus:ring-opacity-50"
                                   placeholder="25565-25570, 25580" />
                            <p class="mt-1 text-xs text-gray-400">Enter individual ports or port ranges separated by commas.</p>
                        </div>

                        {!! csrf_field() !!}
                        <button type="submit"
                                class="w-full px-4 py-2 bg-accent-purple text-white rounded-lg hover:bg-accent-purple/80 transition-colors">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Add Allocations
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $(document).ready(function() {
        const massActionsBtn = $('#mass_actions');

        function updateMassActions() {
            const checkedBoxes = $('input.select-file:checked').length;
            if (checkedBoxes > 0) {
                massActionsBtn.removeClass('hidden');
            } else {
                massActionsBtn.addClass('hidden');
            }
        }

        // Handle individual checkbox selection
        $('[data-action="addSelection"]').on('click', function() {
            updateMassActions();

            // Update select all checkbox
            const totalCheckboxes = $('.select-file:not(:disabled)').length;
            const checkedBoxes = $('.select-file:checked').length;
            $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedBoxes);
        });

        // Handle select all checkbox
        $('#selectAllCheckbox').on('click', function() {
            const isChecked = $(this).prop('checked');
            $('.select-file:not(:disabled)').prop('checked', isChecked);
            updateMassActions();
        });

        // Handle mass deletion
        massActionsBtn.on('click', function() {
            deleteSelected();
        });
    });

    function deleteSelected() {
        const selectedIds = [];
        const selectedItems = [];
        const selectedItemsElements = [];

        $('input.select-file:checked').each(function() {
            const $parent = $(this).closest('tr');
            const id = $(this).data('allocation-id');
            const $ip = $parent.find('td[data-identifier="ip"]');
            const $port = $parent.find('td[data-identifier="port"]');
            const block = `${$ip.text()}:${$port.text()}`;

            selectedIds.push({
                id: id
            });
            selectedItems.push(block);
            selectedItemsElements.push($parent);
        });

        if (selectedItems.length === 0) {
            return;
        }

        const formattedItems = selectedItems
            .slice(0, 5)
            .map(item => `<code>${item}</code>`)
            .join(', ');

        const additionalCount = selectedItems.length - 5;
        const additionalText = additionalCount > 0 ? `, and ${additionalCount} other(s)` : '';

        Swal.fire({
            type: 'warning',
            title: 'Delete Selected Allocations?',
            text: 'Are you sure you want to delete the following allocations: ' + formattedItems + additionalText + '?',
            html: true,
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#ef4444',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            $.ajax({
                method: 'DELETE',
                url: '/admin/nodes/view/' + {{ $node->id }} + '/allocations',
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                data: JSON.stringify({
                    allocations: selectedIds
                }),
                contentType: 'application/json',
                processData: false
            }).done(function() {
                selectedItemsElements.forEach(function(element) {
                    element.addClass('warning').delay(200).fadeOut();
                });

                // Reset checkboxes and mass actions button
                $('.select-file, #selectAllCheckbox').prop('checked', false);
                $('#mass_actions').addClass('hidden');

                Swal.fire({
                    type: 'success',
                    title: 'Allocations Deleted'
                });
            }).fail(function(jqXHR) {
                console.error(jqXHR);
                Swal.fire({
                    type: 'error',
                    title: 'Whoops!',
                    text: 'An error occurred while attempting to delete these allocations. Please try again.'
                });
            });
        });
    }
    </script>
@endsection
