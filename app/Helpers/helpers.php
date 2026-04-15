<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

// ─── Helpers de team ─────────────────────────────────────────────────────────

/**
 * Crea i assigna un personal team a l'usuari si no en té cap.
 */
function add_personal_team(User $user): void
{
    if ($user->ownedTeams()->count() === 0) {
        $team = Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]);
        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
    }
}

// ─── Helpers d'usuaris per defecte (sprints anteriors) ───────────────────────

/**
 * Crea o retorna l'usuari per defecte de l'aplicació.
 * Les credencials es llegeixen de config/users.php → .env
 */
function defaultUser(): User
{
    $data = config('users.default_user');

    $user = User::firstOrCreate(
        ['email' => $data['email']],
        [
            'name'     => $data['name'],
            'password' => Hash::make($data['password']),
        ]
    );

    add_personal_team($user);

    return $user->fresh();
}

/**
 * Crea o retorna el professor per defecte de l'aplicació.
 * Les credencials es llegeixen de config/users.php → .env
 */
function defaultProfessor(): User
{
    $data = config('users.default_professor');

    $user = User::firstOrCreate(
        ['email' => $data['email']],
        [
            'name'        => $data['name'],
            'password'    => Hash::make($data['password']),
            'super_admin' => true,
        ]
    );

    if (! $user->super_admin) {
        $user->update(['super_admin' => true]);
    }

    add_personal_team($user);

    return $user->fresh();
}

/**
 * Crea o retorna el video per defecte de l'aplicació.
 * Les dades es llegeixen de config/videos.php → .env
 */
function defaultVideo(): Video
{
    $data = config('videos.default_video');

    return Video::firstOrCreate(
        ['title' => $data['title']],
        [
            'description'  => $data['description'],
            'url'          => $data['url'],
            'published_at' => now(),
        ]
    );
}

// ─── Nous helpers d'usuaris (Sprint 3) ───────────────────────────────────────

/**
 * Crea o retorna l'usuari regular.
 */
function create_regular_user(): User
{
    $user = User::firstOrCreate(
        ['email' => 'regular@videosapp.com'],
        [
            'name'        => 'regular',
            'password'    => Hash::make('123456789'),
            'super_admin' => false,
        ]
    );

    add_personal_team($user);

    return $user->fresh();
}

/**
 * Crea o retorna el Video Manager i li assigna el permís 'manage-videos'.
 */
function create_video_manager_user(): User
{
    $user = User::firstOrCreate(
        ['email' => 'videosmanager@videosapp.com'],
        [
            'name'        => 'Video Manager',
            'password'    => Hash::make('123456789'),
            'super_admin' => false,
        ]
    );

    add_personal_team($user);

    $permission = Permission::firstOrCreate(['name' => 'manage-videos']);
    if (! $user->hasPermissionTo('manage-videos')) {
        $user->givePermissionTo($permission);
    }

    return $user->fresh();
}

/**
 * Crea o retorna el Super Admin.
 */
function create_superadmin_user(): User
{
    $user = User::firstOrCreate(
        ['email' => 'superadmin@videosapp.com'],
        [
            'name'        => 'Super Admin',
            'password'    => Hash::make('123456789'),
            'super_admin' => true,
        ]
    );

    if (! $user->super_admin) {
        $user->update(['super_admin' => true]);
    }

    add_personal_team($user);

    return $user->fresh();
}

// ─── Gates i permisos ─────────────────────────────────────────────────────────

/**
 * Defineix els Laravel Gates de l'aplicació.
 */
function define_gates(): void
{
    Gate::define('manage-videos', function (User $user): bool {
        return $user->hasPermissionTo('manage-videos') || $user->isSuperAdmin();
    });
}

/**
 * Crea els permisos Spatie necessaris a la base de dades.
 */
function create_permissions(): void
{
    Permission::firstOrCreate(['name' => 'manage-videos']);
}
