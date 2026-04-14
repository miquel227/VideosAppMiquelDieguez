<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Hash;

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

    if ($user->ownedTeams()->count() === 0) {
        $team = Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]);
        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
    }

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
            'name'     => $data['name'],
            'password' => Hash::make($data['password']),
        ]
    );

    if ($user->ownedTeams()->count() === 0) {
        $team = Team::forceCreate([
            'user_id'       => $user->id,
            'name'          => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]);
        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
    }

    return $user->fresh();
}
