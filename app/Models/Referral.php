<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = ['referrer_id', 'invited_email', 'registerd', 'invited_given'];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }
}
