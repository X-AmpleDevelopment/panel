// app/Services/SunLicense.php

namespace App\Services;

class SunLicense
{
    public function check(): array
    {
        // Replace this with actual license validation logic
        return [
            'status' => true,
            'registered_to' => 'X-Ample Development',
            'expires_at' => '2026-01-01',
            'license_type' => 'Premium',
        ];
    }
}
