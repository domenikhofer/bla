<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('category.index');
});

Route::get('category/reorder', [CategoryController::class, 'reorder'])->name('category.reorder');
Route::resource('category', CategoryController::class);

Route::get('/entry/search', [EntryController::class, 'search'])->name('entry.search');
Route::resource('entry', EntryController::class);


Route::get('/download-backup', [BackupController::class, 'downloadBackup']);
