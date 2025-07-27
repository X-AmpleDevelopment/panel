<?php

namespace Pterodactyl\Models;

use Illuminate\Database\Eloquent\Model;

class MythicaluiTheme extends Model
{
    protected $table = 'mythicalui_theme';

    protected $fillable = [
        'keyv',
        'valuev'
    ];

    /**
     * Get a theme value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $record = self::where('keyv', $key)->first();
        return $record ? $record->valuev : $default;
    }

    /**
     * Set a theme value
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public static function setValue(string $key, $value): bool
    {
        return self::updateOrCreate(
            ['keyv' => $key],
            ['valuev' => $value]
        ) !== null;
    }

    /**
     * Delete a theme value
     *
     * @param string $key
     * @return bool
     */
    public static function deleteValue(string $key): bool
    {
        return self::where('keyv', $key)->delete() > 0;
    }
}
