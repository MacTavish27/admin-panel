<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::redirect('/', '/en');
Route::get('/{locale}', [MenuController::class, 'index']);
