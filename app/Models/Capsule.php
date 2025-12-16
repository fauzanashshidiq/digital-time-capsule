<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Capsule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'unlock_date',
        'is_unlocked',
        'unlocked_at',
    ];

    protected $casts = [
        'unlock_date' => 'date',
        'unlocked_at' => 'datetime',
        'is_unlocked' => 'boolean',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Images
    public function images()
    {
        return $this->hasMany(CapsuleImage::class);
    }

    // Helper: apakah capsule sudah bisa dibuka?
    public function canBeUnlocked(): bool
    {
        return now()->greaterThanOrEqualTo($this->unlock_date);
    }

    protected static function booted()
    {
        static::retrieved(function ($capsule) {
            if (
                ! $capsule->is_unlocked &&
                now()->greaterThanOrEqualTo($capsule->unlock_date)
            ) {
                $capsule->updateQuietly([
                    'is_unlocked' => true,
                ]);
            }
        });
    }

    public function remainingLabel(): string
    {
        return Carbon::now()->diffForHumans(
            $this->unlock_date,
            ['parts' => 2, 'short' => false]
        );
    }

    public function agoLabel(): string
    {
        return Carbon::parse($this->unlock_date)->diffForHumans();
    }
}
