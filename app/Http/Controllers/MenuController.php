<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Section;

class MenuController extends Controller
{
    public function index($locale)
    {
        app()->setLocale($locale);

        $menuItems = MenuItem::with('translations')->orderBy('order')->get();
        $sections = Section::with(['contents.translations'])->ordered()->get();
        $sectionsByType = $sections
            ->groupBy('type')
            ->map(fn($group) => $group->values());

        return view('index', compact('menuItems', 'sections', 'sectionsByType'));
    }
}
