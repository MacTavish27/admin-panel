<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
