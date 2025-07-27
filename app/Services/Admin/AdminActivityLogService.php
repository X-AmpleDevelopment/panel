<?php

namespace Pterodactyl\Services\Admin;

use Pterodactyl\Models\AdminActivity;
use Illuminate\Support\Facades\Request;

class AdminActivityLogService
{
    public function log(string $event, int $actorId, string $description)
    {
        return AdminActivity::create([
            'event' => $event,
            'actor_id' => $actorId,
            'description' => $description,
            'ip' => Request::ip(),
            'date' => now(),
        ]);
    }

    public function getForActor(int $actorId, int $limit = 50)
    {
        return AdminActivity::where('actor_id', $actorId)
            ->orderBy('date', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function getByEvent(string $event, int $limit = 25)
    {
        return AdminActivity::where('event', $event)
            ->orderBy('date', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function getLatest(int $limit = 25)
    {
        return AdminActivity::orderBy('date', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function delete(int $id)
    {
        return AdminActivity::findOrFail($id)->delete();
    }
}
