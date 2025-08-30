<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipLevel extends Model
{
    protected $fillable = ['name','min_points','benefits'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
