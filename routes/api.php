<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/entry/search', [EntryController::class, 'search']);
Route::post('entry/store-media', [EntryController::class, 'storeMedia'])->name('entry.storeMedia');
Route::apiResource('entry', EntryController::class);

Route::get('category/types', [CategoryController::class, 'allCategoryTypes']);
Route::apiResource('category', CategoryController::class);

Route::get('/download-backup', [BackupController::class, 'downloadBackup']);
