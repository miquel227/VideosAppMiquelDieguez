<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuaris i video de sprints anteriors
        defaultUser();
        defaultProfessor();

        // Sprint 4: 3 videos per defecte
        defaultVideo();
        defaultVideo2();
        defaultVideo3();

        // Sprint 3: nous usuaris i permisos
        create_permissions();
        create_regular_user();
        create_video_manager_user();
        create_superadmin_user();
    }
}
