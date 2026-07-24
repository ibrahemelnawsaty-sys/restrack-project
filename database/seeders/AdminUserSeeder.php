<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@restrack.sa'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone' => '0500000000',
                'locale' => 'ar',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('super_admin');

        $student = User::firstOrCreate(
            ['email' => 'student@restrack.sa'],
            [
                'name' => 'طالب تجريبي',
                'password' => Hash::make('password'),
                'phone' => '0500000001',
                'locale' => 'ar',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $student->assignRole('student');

        // Give the sample student an active subscription so the student area is previewable.
        \App\Models\Subscription::firstOrCreate(
            ['user_id' => $student->id],
            [
                'status' => 'active',
                'payment_gateway' => 'manual',
                'amount' => 899,
                'currency' => 'SAR',
                'activated_at' => now(),
                'expires_at' => now()->addYear(),
            ]
        );
    }
}
