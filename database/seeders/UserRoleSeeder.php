<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'is_email_verified' => 1,
            'password' => bcrypt('transisi'),
            'remember_token' => Str::random(10)
        ];

        $role_admin = Role::where('name', "admin")->first();
        $role_superadmin = Role::where('name', "super admin")->first();

        $admin = User::create(array_merge([
            'email' => 'admin@transisi.id',
            'name' => 'Admin Transisi',
            'role_id' => $role_superadmin->id,
        ], $default_user_value));

        $user = User::create(array_merge([
            'email' => 'admin-yogyakarta@transisi.id',
            'name' => 'Admin Transisi Yogyakarta',
            'role_id' => $role_admin->id,
        ], $default_user_value));

        $admin->assignRole($role_superadmin->name);
        $user->assignRole($role_admin->name);
    }
}
