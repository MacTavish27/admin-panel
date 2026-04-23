<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['url', 'order'];

    public function translations()
    {
        return $this->hasMany(MenuItemTranslation::class);
    }

    public function getTitleAttribute()
    {
        // $locale = app()->getLocale();

        // $translation = $this->translations
        //     ->where('locale', $locale)
        //     ->first();

        return $this->translations->first()?->title ?? '';
    }
}
