<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Gestió de vídeos (auth + gate) — ha d'anar ABANS del wildcard {video}
Route::middleware(['auth'])->group(function () {
    Route::get('/videos/manage', [VideosManageController::class, 'index'])
        ->name('videos.manage')
        ->can('manage-videos');
});

Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
