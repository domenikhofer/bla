<?php

use App\Http\Controllers\EntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/entry/search', [EntryController::class, 'search']);
