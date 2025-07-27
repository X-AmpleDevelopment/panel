<?php

namespace Pterodactyl\Http\Controllers\Admin\MythicalSystems;

use Pterodactyl\Models\MythicaluiTheme;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Admin\AdminActivityLogService;

class MythicalUIController extends Controller
{
    private array $themeTemplates = [
        'dark-purple' => [
            'colors' => ['#9333EA', '#3B82F6', '#EC4899'],
            'description' => 'Default Theme',
            'settings' => [
                'primary_color' => '#9333EA',
                'secondary_color' => '#3B82F6',
                'tertiary_color' => '#EC4899',
                'background_color' => '#0B0B1E',
                'background_darker' => '#070714',
                'font_family' => 'Inter',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300',
                'enable_particles' => [
                    'name' => 'Background Particles',
                    'description' => 'Enable animated particle effects in the background',
                    'type' => 'toggle',
                    'default' => true
                ]
            ]
        ],
        'cyberpunk' => [
            'colors' => ['#F0DB4F', '#FF0080', '#00FF9F'],
            'description' => 'Neon Vibes',
            'settings' => [
                'primary_color' => '#F0DB4F',
                'secondary_color' => '#FF0080',
                'tertiary_color' => '#00FF9F',
                'background_color' => '#090E1A',
                'background_darker' => '#060911',
                'font_family' => 'Poppins',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-150'
            ]
        ],
        'ocean' => [
            'colors' => ['#0EA5E9', '#2DD4BF', '#818CF8'],
            'description' => 'Deep Sea',
            'settings' => [
                'primary_color' => '#0EA5E9',
                'secondary_color' => '#2DD4BF',
                'tertiary_color' => '#818CF8',
                'background_color' => '#0F172A',
                'background_darker' => '#0A1120',
                'font_family' => 'Inter',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300'
            ]
        ],
        'forest' => [
            'colors' => ['#22C55E', '#84CC16', '#14B8A6'],
            'description' => 'Natural Greens',
            'settings' => [
                'primary_color' => '#22C55E',
                'secondary_color' => '#84CC16',
                'tertiary_color' => '#14B8A6',
                'background_color' => '#0C1A0F',
                'background_darker' => '#070F09',
                'font_family' => 'Montserrat',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300'
            ]
        ],
        'sunset' => [
            'colors' => ['#F97316', '#EF4444', '#EC4899'],
            'description' => 'Warm Colors',
            'settings' => [
                'primary_color' => '#F97316',
                'secondary_color' => '#EF4444',
                'tertiary_color' => '#EC4899',
                'background_color' => '#1A0F0F',
                'background_darker' => '#0F0909',
                'font_family' => 'Roboto',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300'
            ]
        ],
        'monochrome' => [
            'colors' => ['#94A3B8', '#64748B', '#475569'],
            'description' => 'Clean & Simple',
            'settings' => [
                'primary_color' => '#94A3B8',
                'secondary_color' => '#64748B',
                'tertiary_color' => '#475569',
                'background_color' => '#1E1E1E',
                'background_darker' => '#141414',
                'font_family' => 'Inter',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300'
            ]
        ],
        'default' => [
            'colors' => ['#9333EA', '#3B82F6', '#EC4899'],
            'description' => 'Default Theme',
            'settings' => [
                'primary_color' => '#9333EA',
                'secondary_color' => '#3B82F6',
                'tertiary_color' => '#EC4899',
                'background_color' => '#0B0B1E',
                'background_darker' => '#070714',
                'font_family' => 'Inter',
                'base_font_size' => '16px',
                'animation_speed' => 'duration-300'
            ]
        ]
    ];

    public function index(): View
    {
        return view('admin.mythicalsystems.mythicalui', [
            'themeTemplates' => $this->themeTemplates
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $key = $request->input('key');
        $value = $request->input('value');

        if (MythicaluiTheme::setValue($key, $value)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 500);
    }

    public function applyTemplate(Request $request): JsonResponse
    {
        $templateName = $request->input('template');

        if (!isset($this->themeTemplates[$templateName])) {
            return response()->json(['success' => false, 'message' => 'Template not found'], 404);
        }

        $template = $this->themeTemplates[$templateName]['settings'];
        $success = true;

        foreach ($template as $key => $value) {
            if (!MythicaluiTheme::setValue($key, $value)) {
                $success = false;
            }
        }

        return response()->json(['success' => $success]);
    }

    public function uploadImage(Request $request)
    {
        try {
            if (!$request->hasFile('image')) {
                throw new \Exception('No image file provided');
            }

            $file = $request->file('image');
            $type = $request->input('type', 'misc');

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                throw new \Exception('Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');
            }

            // Generate unique filename
            $filename = uniqid($type . '_') . '.' . $file->getClientOriginalExtension();

            // Store in public/assets/images
            $path = $file->storeAs('images', $filename, 'public');

            // Generate public URL
            $url = asset('storage/' . $path);

            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
