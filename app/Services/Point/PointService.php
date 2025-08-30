<?php

namespace App\Services\Point;

use App\Models\User;
use App\Models\PointHistory;

class PointService implements PointServiceInterface
{
    public function addManualPoints(User $user, int $points , ?string $description = null): void
    {
        $user->pointHistories()->create([
            'points' => $points,
            'description' => $description,
            'source_type' => 'manual',
        ]);

        $user->increment('total_points', $points);
    }
}