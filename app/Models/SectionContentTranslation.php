<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionContentTranslation extends Model
{
    protected $fillable = [
        'section_content_id',
        'locale',
        'title',
        'content',
    ];

    public function sectionContent(): BelongsTo
    {
        return $this->belongsTo(SectionContent::class);
    }
}
