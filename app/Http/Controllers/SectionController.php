<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['contents.translations'])->ordered()->get();
        $sectionsByType = $sections
            ->groupBy('type')
            ->map(fn ($group) => $group->values());

        return view('index', compact('sections', 'sectionsByType'));
    }
}
