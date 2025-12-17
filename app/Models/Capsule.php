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
        return now()->greaterThanOrEqualTo($this->unlock_date->startOfDay());
    }

    protected static function booted()
    {
        static::retrieved(function ($capsule) {
            if (
                ! $capsule->is_unlocked &&
                now()->startOfDay()->greaterThanOrEqualTo(
                    $capsule->unlock_date->startOfDay()
                )
            ) {
                $capsule->updateQuietly([
                    'is_unlocked' => true,
                ]);
            }
        });
    }

    public function remainingLabel(): string
    {
        if ($this->is_unlocked) {
            return 'Unlocked';
        }

        return now()->diffForHumans(
            $this->unlock_date,
            [
                'parts' => 2,
                'join' => true,
                'syntax' => Carbon::DIFF_ABSOLUTE,
            ]
        ) . ' remaining';
    }

    public function agoLabel(): string
    {
        $today = now()->startOfDay();
        $unlockDay = $this->unlock_date->startOfDay();

            // Kalau hari ini
        if ($unlockDay->equalTo($today)) {
            return 'Today';
        }

        return $today->diffForHumans(
            $this->unlock_date->startOfDay(),
            [
                'parts' => 2,
                'join' => true,
                'syntax' => Carbon::DIFF_ABSOLUTE,
            ]
        ) . ' ago';
    }
}
