<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ─── Rutes d'usuaris (auth) — manage ABANS del wildcard {user} ───────────────
Route::middleware(['auth'])->group(function () {

    Route::get('/users', [UsersController::class, 'index'])
        ->name('users.index');

    // Gestió d'usuaris (cal posar-les ABANS del wildcard {user})
    Route::get('/users/manage', [UsersManageController::class, 'index'])
        ->name('users.manage')
        ->can('manage-users');

    Route::get('/users/manage/create', [UsersManageController::class, 'create'])
        ->name('users.manage.create')
        ->can('create-users');

    Route::post('/users/manage', [UsersManageController::class, 'store'])
        ->name('users.manage.store')
        ->can('create-users');

    Route::get('/users/manage/{user}/edit', [UsersManageController::class, 'edit'])
        ->name('users.manage.edit')
        ->can('edit-users');

    Route::put('/users/manage/{user}', [UsersManageController::class, 'update'])
        ->name('users.manage.update')
        ->can('edit-users');

    Route::get('/users/manage/{user}/delete', [UsersManageController::class, 'delete'])
        ->name('users.manage.delete')
        ->can('delete-users');

    Route::delete('/users/manage/{user}', [UsersManageController::class, 'destroy'])
        ->name('users.manage.destroy')
        ->can('delete-users');

    // Perfil públic d'usuari (wildcard al final)
    Route::get('/users/{user}', [UsersController::class, 'show'])
        ->name('users.show');
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
