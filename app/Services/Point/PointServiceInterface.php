<?php

namespace App\Services\Point;

use App\Models\User;

interface PointServiceInterface
{
    public function addManualPoints(User $user, int $points, ?string $description = null): void;
}