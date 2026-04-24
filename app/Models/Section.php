<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Section extends Model
{
    protected $fillable = [
        'type',
        'title',
        'content',
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

    public function items()
    {
        return $this->hasMany(SectionItem::class)->orderBy('order');
    }
}
