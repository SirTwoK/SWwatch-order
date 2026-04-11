<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWatchState extends Model
{
    protected $fillable = [
        'user_id',
        'watch_entry_id',
        'watched',
    ];

    protected $casts = [
        'watched' => 'boolean',
    ];
}
