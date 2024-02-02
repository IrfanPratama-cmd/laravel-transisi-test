<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_superadmin = Role::create(['name' => 'super admin' , 'guard_name' => 'web']);
        $role_admin = Role::create(['name' => 'admin' , 'guard_name' => 'web']);

        $role_superadmin->givePermissionTo(['read-master-data', 'read-user-management', 'read-dashboard']);
        $role_superadmin->givePermissionTo(['read-role','create-role', 'update-role', 'delete-role']);
        $role_superadmin->givePermissionTo(['read-permission','create-permission', 'update-permission', 'delete-permission']);
        $role_superadmin->givePermissionTo(['read-user','create-user', 'update-user', 'delete-user']);
        $role_superadmin->givePermissionTo(['read-division','create-division', 'update-division', 'delete-division']);
        $role_superadmin->givePermissionTo(['read-position','create-position', 'update-position', 'delete-position']);
        $role_superadmin->givePermissionTo(['read-company','create-company', 'update-company', 'delete-company']);
        $role_superadmin->givePermissionTo(['read-employee','create-employee', 'update-employee', 'delete-employee']);

        $role_admin->givePermissionTo('read-dashboard');

    }
}
