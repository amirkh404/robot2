<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = ['title', 'cost_points', 'stock', 'is_active'];

    public function userRewards()
    {
        return $this->hasMany(UserReward::class);
    }
}
