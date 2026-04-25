<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SectionContent extends Model
{
    protected $fillable = [
        'section_id',
        'key',
        'kind',
        'title',
        'content',
        'image',
        'extra',
        'order',
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(SectionContentTranslation::class)->orderBy('locale');
    }

    public function getTranslatedTitleAttribute(): ?string
    {
        return $this->getTranslatedAttributeValue('title');
    }

    public function getTranslatedContentAttribute(): ?string
    {
        return $this->getTranslatedAttributeValue('content');
    }

    protected function getTranslatedAttributeValue(string $attribute): ?string
    {
        $locale = app()->getLocale();

        $translation = $this->relationLoaded('translations')
            ? $this->translations->firstWhere('locale', $locale)
            : $this->translations()->where('locale', $locale)->first();

        return $translation?->{$attribute} ?: $this->getAttributeFromArray($attribute);
    }
}
