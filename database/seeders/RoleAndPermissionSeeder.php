<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage_users', 'manage_speakers', 'manage_levels', 'manage_lectures',
            'manage_questions', 'manage_subscriptions', 'manage_coupons', 'manage_faqs',
            'manage_guidelines', 'manage_pages', 'manage_seo', 'manage_settings',
            'manage_contacts', 'view_surveys', 'view_dashboard',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        Role::firstOrCreate(['name' => 'student']);
    }
}
