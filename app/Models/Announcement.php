<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'type',
        'image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
