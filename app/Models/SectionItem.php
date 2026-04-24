<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'content',
        'image',
        'extra',
        'order'
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
