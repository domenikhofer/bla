<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('category/reorder', [CategoryController::class, 'reorder'])->name('category.reorder');
Route::resource('category', CategoryController::class);

Route::get('/download-backup', [BackupController::class, 'downloadBackup']);


