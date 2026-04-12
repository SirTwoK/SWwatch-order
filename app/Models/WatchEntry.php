<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WatchEntry extends Model
{
    protected $fillable = [
        'order', 'title', 'type', 'series_name', 'season', 'episode',
        'era', 'era_label', 'timeline', 'duration_minutes',
        'recommendation', 'thumbnail_color', 'synopsis', 'watched', 'thumbnail_position', 'before_watch', 'after_watch',
    ];

    protected $casts = ['watched' => 'boolean'];

    // "2h 16m" or "39m"
    public function getFormattedDurationAttribute(): string
    {
        $h = intdiv($this->duration_minutes, 60);
        $m = $this->duration_minutes % 60;
        return $h > 0 ? ($m > 0 ? "{$h}h {$m}m" : "{$h}h") : "{$m}m";
    }

    public function userState()
    {
        return $this->hasOne(UserWatchState::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}