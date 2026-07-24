<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            AdminUserSeeder::class,
            SiteSettingsSeeder::class,
            SampleDataSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
