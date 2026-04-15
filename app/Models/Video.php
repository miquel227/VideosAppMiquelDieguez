<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url',
        'published_at',
        'previous',
        'next',
        'series_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }

    // Retorna "13 de gener de 2025"
    public function getFormattedPublishedAtAttribute(): ?string
    {
        if ($this->published_at === null) {
            return null;
        }

        return $this->published_at->locale('ca')->isoFormat('D [de] MMMM [de] YYYY');
    }

    // Retorna "fa 2 hores"
    public function getFormattedForHumansPublishedAtAttribute(): ?string
    {
        if ($this->published_at === null) {
            return null;
        }

        return $this->published_at->locale('ca')->diffForHumans();
    }

    // Retorna el Unix timestamp
    public function getPublishedAtTimestampAttribute(): ?int
    {
        if ($this->published_at === null) {
            return null;
        }

        return $this->published_at->timestamp;
    }
}
