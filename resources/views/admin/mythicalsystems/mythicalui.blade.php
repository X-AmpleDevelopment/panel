@extends('layouts.admin')

@section('title')
MythicalUI Theme Editor
@endsection

@section('content')
<div class="flex flex-col space-y-6">
    <!-- Header with Live Preview -->
    <div class="glass-card p-6 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-accent-purple/10 rounded-xl">
                    <i class="fas fa-paint-brush text-2xl text-accent-purple"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-100">Theme Editor</h1>
                    <p class="text-gray-400">Customize your panel's appearance</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="resetToDefaults()"
                        class="px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-all">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>
                <button onclick="exportTheme()"
                        class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg hover:bg-blue-500/20 transition-all">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button onclick="importTheme()"
                        class="px-4 py-2 bg-green-500/10 text-green-400 rounded-lg hover:bg-green-500/20 transition-all">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
            </div>
        </div>

        <!-- Live Preview Section -->
        <div class="mt-6 p-4 bg-background-darker rounded-xl border border-gray-700">
            <h3 class="text-sm font-medium text-gray-400 mb-3">Live Preview</h3>
            <div class="grid grid-cols-3 gap-4">
                <!-- Button Preview -->
                <div class="preview-item p-3 rounded-lg bg-background">
                    <label class="text-xs text-gray-500 mb-2 block">Button</label>
                    <button class="px-4 py-2 bg-accent-purple text-white rounded-lg hover:opacity-90 transition-all">
                        Sample Button
                    </button>
                </div>

                <!-- Card Preview -->
                <div class="preview-item p-3 rounded-lg bg-background">
                    <label class="text-xs text-gray-500 mb-2 block">Card</label>
                    <div class="glass-card p-3 rounded-lg">
                        <h4 class="text-sm font-medium">Card Title</h4>
                        <p class="text-xs text-gray-400">Sample content</p>
                    </div>
                </div>

                <!-- Text Preview -->
                <div class="preview-item p-3 rounded-lg bg-background">
                    <label class="text-xs text-gray-500 mb-2 block">Typography</label>
                    <h4 class="gradient-text text-lg font-bold">Gradient Text</h4>
                    <p class="text-sm">Regular Text</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Editor Grid -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Column - Quick Templates -->
        <div class="col-span-3">
            <div class="glass-card p-6 h-full">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Quick Templates</h2>
                <div class="space-y-4">
                    @foreach(['dark-purple', 'cyberpunk', 'ocean', 'forest', 'sunset', 'monochrome'] as $template)
                        <button onclick="applyThemeTemplate('{{ $template }}')"
                                class="w-full p-4 rounded-xl glass-card hover:transform hover:scale-[1.02] transition-all">
                            <div class="flex items-center space-x-3">
                                <div class="template-preview w-12 h-12 rounded-lg overflow-hidden relative">
                                    <!-- Template Preview Colors -->
                                    @foreach($themeTemplates[$template]['colors'] as $index => $color)
                                        <div class="absolute w-full h-1/3"
                                             style="background: {{ $color }}; top: {{ $index * 33.33 }}%">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-left">
                                    <div class="text-sm font-medium">{{ ucfirst($template) }}</div>
                                    <div class="text-xs text-gray-400">{{ $themeTemplates[$template]['description'] }}</div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Center Column - Color & Typography -->
        <div class="col-span-6 space-y-6">
            <!-- Branding -->
            <div class="glass-card p-6">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Branding</h2>
                <div class="grid grid-cols-1 gap-6">
                    <!-- Panel Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Panel Name</label>
                        <input type="text"
                            class="w-full px-4 py-3 bg-background text-white rounded-lg border border-gray-700"
                            data-setting="panel_name"
                            value="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('panel_name', config('app.name')) }}"
                            placeholder="Enter panel name" disabled>
                    </div>

                    <!-- Logo URL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Logo URL</label>
                        <div class="flex items-center space-x-4">
                            <input type="text"
                                class="flex-1 px-4 py-3 bg-background text-white rounded-lg border border-gray-700"
                                data-setting="logo_url"
                                value="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('logo_url', '') }}"
                                placeholder="Enter logo URL">
                            <button onclick="uploadImage('logo')"
                                class="px-4 py-3 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-all">
                                <i class="fas fa-upload"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <img id="logoPreview" src="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('logo_url', '') }}"
                                class="max-h-12 rounded hidden">
                        </div>
                    </div>

                    <!-- Background URL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Background Image URL</label>
                        <div class="flex items-center space-x-4">
                            <input type="text"
                                class="flex-1 px-4 py-3 bg-background text-white rounded-lg border border-gray-700"
                                data-setting="background_url"
                                value="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_url', '') }}"
                                placeholder="Enter background image URL">
                            <button onclick="uploadImage('background')"
                                class="px-4 py-3 bg-accent-purple/10 text-accent-purple rounded-lg hover:bg-accent-purple/20 transition-all">
                                <i class="fas fa-upload"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <img id="backgroundPreview" src="{{ \Pterodactyl\Models\MythicaluiTheme::getValue('background_url', '') }}"
                                class="max-h-24 rounded w-full object-cover hidden">
                        </div>

                        <!-- Particles Toggle -->
                         <br>
                        <div>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox"
                                    class="form-checkbox h-5 w-5 text-accent-purple rounded border-gray-700 bg-background focus:ring-accent-purple"
                                    data-setting="enable_particles"
                                    {{ \Pterodactyl\Models\MythicaluiTheme::getValue('enable_particles', 'true') === 'true' ? 'checked' : '' }}>
                                <div>
                                    <div class="text-sm font-medium text-gray-200">Background Particles</div>
                                    <div class="text-xs text-gray-400">Enable animated particle effects in the background</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Color Editor -->
            <div class="glass-card p-6">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Color Scheme</h2>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        'primary_color' => 'Primary',
                        'secondary_color' => 'Secondary',
                        'tertiary_color' => 'Tertiary',
                        'background_color' => 'Background',
                        'background_darker' => 'Background Dark'
                    ] as $key => $label)
                        <div class="color-picker-wrapper">
                            <label class="block text-sm font-medium text-gray-200 mb-2">{{ $label }}</label>
                            <div class="relative">
                                <div class="color-picker" id="{{ $key }}_picker"
                                     data-color="{{ \Pterodactyl\Models\MythicaluiTheme::getValue($key, '#000000') }}"
                                     data-setting="{{ $key }}">
                                </div>
                                <div class="color-preview h-12 rounded-lg border border-gray-700 mt-2"
                                     id="{{ $key }}_preview"
                                     style="background: {{ \Pterodactyl\Models\MythicaluiTheme::getValue($key, '#000000') }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Typography Editor -->
            <div class="glass-card p-6">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Typography</h2>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Font Family -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Font Family</label>
                        <div class="relative">
                            <select class="w-full appearance-none px-4 py-3 bg-background text-white rounded-lg border border-gray-700"
                                    data-setting="font_family">
                                @foreach(['Inter', 'Roboto', 'Open Sans', 'Poppins', 'Montserrat'] as $font)
                                    <option value="{{ $font }}"
                                            {{ \Pterodactyl\Models\MythicaluiTheme::getValue('font_family') === $font ? 'selected' : '' }}>
                                        {{ $font }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Font Size -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Base Size</label>
                        <div class="relative">
                            <input type="range"
                                   min="12"
                                   max="20"
                                   step="1"
                                   value="{{ (int)str_replace('px', '', \Pterodactyl\Models\MythicaluiTheme::getValue('base_font_size', '16px')) }}"
                                   class="w-full"
                                   data-setting="base_font_size">
                            <div class="text-sm text-gray-400 mt-1">
                                {{ \Pterodactyl\Models\MythicaluiTheme::getValue('base_font_size', '16px') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Features & Effects -->
        <div class="col-span-3 space-y-6">
            <!-- Animation Settings -->
            <div class="glass-card p-6">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Effects</h2>
                <div class="space-y-4">
                    <!-- Animation Speed -->
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-2">Animation Speed</label>
                        <div class="relative">
                            <select class="w-full appearance-none px-4 py-3 bg-background text-white rounded-lg border border-gray-700"
                                    data-setting="animation_speed">
                                @foreach([
                                    'duration-150' => 'Fast',
                                    'duration-300' => 'Normal',
                                    'duration-500' => 'Slow',
                                    'duration-0' => 'Off'
                                ] as $value => $label)
                                    <option value="{{ $value }}"
                                            {{ \Pterodactyl\Models\MythicaluiTheme::getValue('animation_speed') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Toggles -->
                    @foreach([
                        'enable_preloader' => 'Page Preloader',
                        'enable_blur_effects' => 'Blur Effects',
                        'enable_animations' => 'UI Animations',
                    ] as $key => $label)
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-200">{{ $label }}</label>
                            <label class="switch">
                                <input type="checkbox"
                                       data-setting="{{ $key }}"
                                       {{ \Pterodactyl\Models\MythicaluiTheme::getValue($key, 'true') === 'true' ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Features -->
            <div class="glass-card p-6">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Features</h2>
                <div class="space-y-4">
                    @foreach([
                        'enable_memory_converter' => 'Memory Converter',
                        'enable_number_formatter' => 'Number Formatter',
                        'enable_seasonal_events' => 'Seasonal Events',
                        'enable_api_tester' => 'API Tester',
                        'enable_allocation_helper' => 'Allocation Helper'
                    ] as $key => $label)
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-200">{{ $label }}</label>
                            <label class="switch">
                                <input type="checkbox"
                                       data-setting="{{ $key }}"
                                       {{ \Pterodactyl\Models\MythicaluiTheme::getValue($key, 'true') === 'true' ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles for Editor -->
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255,255,255,0.1);
    transition: .3s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .3s;
}

input:checked + .slider {
    background-color: var(--primary-color);
}

input:checked + .slider:before {
    transform: translateX(24px);
}

.slider.round {
    border-radius: 24px;
}

.slider.round:before {
    border-radius: 50%;
}

.color-preview {
    position: relative;
}

.color-preview::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 0.5rem;
    background: linear-gradient(rgba(255,255,255,0.1), transparent);
}

input[type="range"] {
    -webkit-appearance: none;
    background: rgba(255,255,255,0.1);
    border-radius: 1rem;
    height: 0.5rem;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    background: var(--primary-color);
    cursor: pointer;
    border: 2px solid rgba(255,255,255,0.2);
}

.pickr {
    position: relative;
    overflow: visible;
}

.pickr button {
    width: 100% !important;
    height: 48px !important;
    border-radius: 0.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: var(--background-darker) !important;
}

.pickr button::before {
    border-radius: 0.5rem;
}

.pcr-app {
    background: var(--background-darker) !important;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
}

.pcr-interaction input {
    color: white !important;
    background: rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.pcr-interaction .pcr-save {
    background: var(--primary-color) !important;
}

.switch input:checked + .slider {
    background: var(--primary-color) !important;
}
</style>

@endsection

@section('footer-scripts')
@parent
<script>
$(document).ready(function() {
    // Initialize color pickers
    $('.color-picker').each(function() {
        const $this = $(this);
        const $preview = $(`#${$this.data('setting')}_preview`);

        const pickr = Pickr.create({
            el: this,
            theme: 'nano',
            default: $this.data('color'),
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: true,
                    hsla: true,
                    input: true,
                    save: true
                }
            }
        });

        pickr.on('save', (color) => {
            const value = color.toHEXA().toString();
            $preview.css('background', value);
            updateSetting($this.data('setting'), value);
            pickr.hide();
        });
    });

    // Fix for effects and features toggles
    $('input[type="checkbox"][data-setting]').on('change', function() {
        const key = $(this).data('setting');
        const value = $(this).prop('checked').toString();
        updateSetting(key, value);
    });

    // Handle select inputs
    $('select[data-setting]').on('change', function() {
        const key = $(this).data('setting');
        const value = $(this).val();
        updateSetting(key, value);
    });

    // Handle range input
    $('input[type="range"][data-setting]').on('input', function() {
        const key = $(this).data('setting');
        const value = $(this).val() + 'px';
        $(this).next('.text-sm').text(value);
        updateSetting(key, value);
    });
});

function updateSetting(key, value) {
    // Show loading state
    const $element = $(`[data-setting="${key}"]`);
    const originalState = $element.prop('disabled');
    $element.prop('disabled', true);

    $.ajax({
        url: '/admin/mythicalsystems/mythicalui/update',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        data: {
            key: key,
            value: value
        },
        success: function(response) {
            if (response.success) {
                // Update UI immediately for toggles
                if ($element.is(':checkbox')) {
                    $element.prop('checked', value === 'true');
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Setting updated!',
                    text: "The setting has been updated successfully.",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    background: '#1E1E30',
                    iconColor: '#4ADE80',
                    customClass: {
                        popup: 'bg-accent-purple/50',
                        title: 'text-white',
                        content: 'text-gray-200',
                    }
                });

                // Reload preview elements if needed
                updatePreview(key, value);
            }
        },
        error: function(xhr) {
            // Revert to original state on error
            if ($element.is(':checkbox')) {
                $element.prop('checked', !$element.prop('checked'));
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update setting.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: '#1E1E30',
                iconColor: '#EF4444'
            });
        },
        complete: function() {
            $element.prop('disabled', originalState);
        }
    });
}

function updatePreview(key, value) {
    // Update live preview elements based on settings
    if (key.startsWith('enable_')) {
        const feature = key.replace('enable_', '');
        $(`.preview-${feature}`).toggleClass('active', value === 'true');
    }

    // Update theme colors
    if (key.includes('color')) {
        document.documentElement.style.setProperty(`--${key}`, value);
    }
}

function applyThemeTemplate(templateName) {
    Swal.fire({
        title: 'Applying theme...',
        html: 'Please wait while we update your theme settings',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '/admin/mythicalsystems/mythicalui/template',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        data: { template: templateName },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Theme Applied!',
                    text: 'The theme template has been applied successfully.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to apply theme template.',
                    showConfirmButton: true
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to apply theme template.',
                showConfirmButton: true
            });
        }
    });
}

function exportTheme() {
    const settings = {};
    $('[data-setting]').each(function() {
        const key = $(this).data('setting');
        settings[key] = $(this).val() || $(this).prop('checked');
    });

    const blob = new Blob([JSON.stringify(settings, null, 2)], {type: 'application/json'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'mythicalui-theme.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function importTheme() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.json';
    input.onchange = e => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = event => {
            try {
                const settings = JSON.parse(event.target.result);
                Object.entries(settings).forEach(([key, value]) => {
                    updateSetting(key, value);
                });
                setTimeout(() => window.location.reload(), 1000);
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Theme File',
                    text: 'The selected file is not a valid theme configuration.'
                });
            }
        };
        reader.readAsText(file);
    };
    input.click();
}

function resetToDefaults() {
    Swal.fire({
        title: 'Reset to Defaults?',
        text: 'This will restore all theme settings to their default values.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc2626'
    }).then((result) => {
        if (result.isConfirmed) {
            applyThemeTemplate('dark-purple');
        }
    });
}

// Handle image uploads
function uploadImage(type) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';

    input.onchange = async (e) => {
        const file = e.target.files[0];
        if (!file) return;

        // Show loading state
        Swal.fire({
            title: 'Uploading...',
            text: 'Please wait while we upload your image',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('type', type);

            const response = await fetch('/admin/mythicalsystems/mythicalui/upload-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                // Update input and preview
                const input = document.querySelector(`[data-setting="${type}_url"]`);
                const preview = document.getElementById(`${type}Preview`);

                input.value = data.url;
                preview.src = data.url;
                preview.classList.remove('hidden');

                // Update setting
                updateSetting(`${type}_url`, data.url);

                Swal.fire({
                    icon: 'success',
                    title: 'Upload Complete',
                    text: 'Image has been uploaded successfully',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || 'Upload failed');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Upload Failed',
                text: error.message
            });
        }
    };

    input.click();
}

// Handle image preview updates
document.addEventListener('DOMContentLoaded', function() {
    const logoPreview = document.getElementById('logoPreview');
    const backgroundPreview = document.getElementById('backgroundPreview');
    const logoUrl = document.querySelector('[data-setting="logo_url"]');
    const backgroundUrl = document.querySelector('[data-setting="background_url"]');

    function updatePreview(input, preview) {
        if (input.value) {
            preview.src = input.value;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    }

    logoUrl.addEventListener('input', () => updatePreview(logoUrl, logoPreview));
    backgroundUrl.addEventListener('input', () => updatePreview(backgroundUrl, backgroundPreview));

    // Initial preview
    updatePreview(logoUrl, logoPreview);
    updatePreview(backgroundUrl, backgroundPreview);
});
</script>
@endsection

