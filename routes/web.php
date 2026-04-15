<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ─── Rutes de gestió de vídeos (auth + gates) — ABANS dels wildcards ─────────
Route::middleware(['auth'])->group(function () {

    Route::get('/videos/manage', [VideosManageController::class, 'index'])
        ->name('videos.manage')
        ->can('manage-videos');

    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])
        ->name('videos.manage.create')
        ->can('create-videos');

    Route::post('/videos/manage', [VideosManageController::class, 'store'])
        ->name('videos.manage.store')
        ->can('create-videos');

    Route::get('/videos/manage/{video}/edit', [VideosManageController::class, 'edit'])
        ->name('videos.manage.edit')
        ->can('edit-videos');

    Route::put('/videos/manage/{video}', [VideosManageController::class, 'update'])
        ->name('videos.manage.update')
        ->can('edit-videos');

    Route::get('/videos/manage/{video}/delete', [VideosManageController::class, 'delete'])
        ->name('videos.manage.delete')
        ->can('delete-videos');

    Route::delete('/videos/manage/{video}', [VideosManageController::class, 'destroy'])
        ->name('videos.manage.destroy')
        ->can('delete-videos');
});

// ─── Rutes públiques de vídeos ────────────────────────────────────────────────
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideosController::class, 'show'])->name('videos.show');

// ─── Dashboard (Jetstream) ────────────────────────────────────────────────────
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
