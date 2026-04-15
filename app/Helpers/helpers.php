<?php

use App\Models\Serie;
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
 * Crea o retorna el primer video per defecte de l'aplicació.
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

/**
 * Crea o retorna el segon video per defecte de l'aplicació.
 */
function defaultVideo2(): Video
{
    return Video::firstOrCreate(
        ['title' => 'Video per defecte 2'],
        [
            'description'  => 'Descripció del segon video per defecte',
            'url'          => 'https://www.youtube.com/watch?v=abc123def45',
            'published_at' => now(),
        ]
    );
}

/**
 * Crea o retorna el tercer video per defecte de l'aplicació.
 */
function defaultVideo3(): Video
{
    return Video::firstOrCreate(
        ['title' => 'Video per defecte 3'],
        [
            'description'  => 'Descripció del tercer video per defecte',
            'url'          => 'https://www.youtube.com/watch?v=xyz789uvw12',
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
 * Crea o retorna el Video Manager i li assigna tots els permisos CRUD de vídeos.
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

    $permissions = [
        'manage-videos',  'create-videos',  'edit-videos',  'delete-videos',
        'manage-series',  'create-series',  'edit-series',  'delete-series',
    ];
    foreach ($permissions as $permName) {
        $perm = Permission::firstOrCreate(['name' => $permName]);
        if (! $user->hasPermissionTo($permName)) {
            $user->givePermissionTo($perm);
        }
    }

    return $user->fresh();
}

/**
 * Crea o retorna el Super Admin i li assigna els permisos de gestió d'usuaris.
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

    $userPermissions = [
        'manage-users',  'create-users',  'edit-users',  'delete-users',
        'manage-series', 'create-series', 'edit-series', 'delete-series',
    ];
    foreach ($userPermissions as $permName) {
        $perm = Permission::firstOrCreate(['name' => $permName]);
        if (! $user->hasPermissionTo($permName)) {
            $user->givePermissionTo($perm);
        }
    }

    return $user->fresh();
}

// ─── Helpers de sèries (Sprint 6) ────────────────────────────────────────────

/**
 * Crea 3 sèries per defecte a la base de dades.
 */
function create_series(): void
{
    Serie::firstOrCreate(
        ['title' => 'Sèrie per defecte 1'],
        [
            'description'   => 'Descripció de la primera sèrie per defecte',
            'user_name'     => 'Admin',
            'user_photo_url' => null,
            'published_at'  => now(),
        ]
    );

    Serie::firstOrCreate(
        ['title' => 'Sèrie per defecte 2'],
        [
            'description'   => 'Descripció de la segona sèrie per defecte',
            'user_name'     => 'Admin',
            'user_photo_url' => null,
            'published_at'  => now(),
        ]
    );

    Serie::firstOrCreate(
        ['title' => 'Sèrie per defecte 3'],
        [
            'description'   => 'Descripció de la tercera sèrie per defecte',
            'user_name'     => 'Admin',
            'user_photo_url' => null,
            'published_at'  => now(),
        ]
    );
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

    Gate::define('create-videos', function (User $user): bool {
        return $user->hasPermissionTo('create-videos') || $user->isSuperAdmin();
    });

    Gate::define('edit-videos', function (User $user): bool {
        return $user->hasPermissionTo('edit-videos') || $user->isSuperAdmin();
    });

    Gate::define('delete-videos', function (User $user): bool {
        return $user->hasPermissionTo('delete-videos') || $user->isSuperAdmin();
    });

    Gate::define('manage-users', function (User $user): bool {
        return $user->hasPermissionTo('manage-users') || $user->isSuperAdmin();
    });

    Gate::define('create-users', function (User $user): bool {
        return $user->hasPermissionTo('create-users') || $user->isSuperAdmin();
    });

    Gate::define('edit-users', function (User $user): bool {
        return $user->hasPermissionTo('edit-users') || $user->isSuperAdmin();
    });

    Gate::define('delete-users', function (User $user): bool {
        return $user->hasPermissionTo('delete-users') || $user->isSuperAdmin();
    });

    Gate::define('manage-series', function (User $user): bool {
        return $user->hasPermissionTo('manage-series') || $user->isSuperAdmin();
    });

    Gate::define('create-series', function (User $user): bool {
        return $user->hasPermissionTo('create-series') || $user->isSuperAdmin();
    });

    Gate::define('edit-series', function (User $user): bool {
        return $user->hasPermissionTo('edit-series') || $user->isSuperAdmin();
    });

    Gate::define('delete-series', function (User $user): bool {
        return $user->hasPermissionTo('delete-series') || $user->isSuperAdmin();
    });
}

/**
 * Crea els permisos Spatie necessaris a la base de dades.
 */
function create_permissions(): void
{
    $permissions = [
        'manage-videos',  'create-videos',  'edit-videos',  'delete-videos',
        'manage-users',   'create-users',   'edit-users',   'delete-users',
        'manage-series',  'create-series',  'edit-series',  'delete-series',
    ];
    foreach ($permissions as $name) {
        Permission::firstOrCreate(['name' => $name]);
    }
}
