<?php

namespace Pterodactyl\Models;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    public $timestamps = false;
    protected $table = 'admin_activity';
    protected $fillable = ['event', 'actor_id', 'description', 'ip', 'date'];

    protected $casts = [
        'date' => 'datetime',
        'event' => 'string',
        'actor_id' => 'integer',
        'description' => 'string',
        'ip' => 'string',
    ];

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    // Add this accessor to make it compatible with the view
    public function getCreatedAtAttribute()
    {
        return $this->date;
    }
}
