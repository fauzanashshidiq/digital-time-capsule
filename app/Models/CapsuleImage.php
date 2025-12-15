<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapsuleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'capsule_id',
        'image_path',
    ];

    // Relasi ke Capsule
    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }
}
