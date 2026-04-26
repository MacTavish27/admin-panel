<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Section extends Model
{
    protected $fillable = [
        'type',
        'name',
        'image',
        'extra',
        'order'
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(SectionContent::class)->orderBy('order');
    }

    public function items(): HasMany
    {
        return $this->contents();
    }

    public function contentByKey(string $key): ?SectionContent
    {
        if ($this->relationLoaded('contents')) {
            return $this->contents->firstWhere('key', $key);
        }

        return $this->contents()->where('key', $key)->first();
    }

    public function contentsByKind(string $kind): Collection
    {
        if ($this->relationLoaded('contents')) {
            return $this->contents->where('kind', $kind)->values();
        }

        return $this->contents()->where('kind', $kind)->get();
    }

    public function getImageUrlAttribute(): ?string
    {
        $path = $this->image;

        if (! $path) {
            return null;
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        return asset(ltrim($path, '/'));
    }
}
