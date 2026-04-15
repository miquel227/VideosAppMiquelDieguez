<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        defaultUser();
        defaultProfessor();
        defaultVideo();

        create_permissions();
        create_regular_user();
        create_video_manager_user();
        create_superadmin_user();
    }
}
