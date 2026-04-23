<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($locale)
    {
        app()->setLocale($locale);

        $menuItems = MenuItem::with('translations')->orderBy('order')->get();

        return view('index', compact('menuItems'));
    }
}
