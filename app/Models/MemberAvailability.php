<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MemberAvailability extends Model
{
    protected $fillable = ['user_id', 'date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
