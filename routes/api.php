<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // User authenticated successfully
        return response()->json([
            'message' => 'Login successful!',
        ]);
    } else {
        return response()->json([
            'message' => 'Invalid login credentials!',
        ], 401);
    }
});

Route::post('/logout', function () {
    auth()->logout(); // For session-based authentication

    return response()->json([
        'message' => 'Successfully logged out!',
    ]);
});

Route::get('/entry/search', [EntryController::class, 'search']);
Route::post('entry/store-media', [EntryController::class, 'storeMedia'])->name('entry.storeMedia');
Route::apiResource('entry', EntryController::class);

Route::get('category/types', [CategoryController::class, 'allCategoryTypes']);
Route::apiResource('category', CategoryController::class);

Route::get('/download-backup', [BackupController::class, 'downloadBackup']);
