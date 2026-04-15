<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_name',
        'user_photo_url',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function testedBy(): string
    {
        return \Tests\Unit\SerieTest::class;
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'series_id');
    }

    // Retorna "13 de gener de 2025"
    public function getFormattedCreatedAtAttribute(): ?string
    {
        if ($this->created_at === null) {
            return null;
        }

        return $this->created_at->locale('ca')->isoFormat('D [de] MMMM [de] YYYY');
    }

    // Retorna "fa 2 hores"
    public function getFormattedForHumansCreatedAtAttribute(): ?string
    {
        if ($this->created_at === null) {
            return null;
        }

        return $this->created_at->locale('ca')->diffForHumans();
    }

    // Retorna el Unix timestamp
    public function getCreatedAtTimestampAttribute(): ?int
    {
        if ($this->created_at === null) {
            return null;
        }

        return $this->created_at->timestamp;
    }
}
