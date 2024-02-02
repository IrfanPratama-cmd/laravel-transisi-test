<?php

namespace Database\Seeders;

use App\Models\Modul;
use App\Models\ModulPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Modul::create(['name' => 'role']);
        $user = Modul::create(['name' => 'user']);
        $permission = Modul::create(['name' => 'permission']);
        $master = Modul::create(['name' => 'master']);
        $division = Modul::create(['name' => 'division']);
        $position = Modul::create(['name' => 'position']);
        $employee = Modul::create(['name' => 'employee']);
        $company = Modul::create(['name' => 'company']);

        $read_role = Permission::create(['name' => 'read-role' , 'modul_id' => $role->id, 'guard_name' => 'web']);
        $create_role = Permission::create(['name' => 'create-role' , 'modul_id' => $role->id, 'guard_name' => 'web']);
        $update_role = Permission::create(['name' => 'update-role' , 'modul_id' => $role->id,'guard_name' => 'web']);
        $delete_role = Permission::create(['name' => 'delete-role' , 'modul_id' => $role->id, 'guard_name' => 'web']);

        $read_division = Permission::create(['name' => 'read-division' , 'modul_id' => $division->id, 'guard_name' => 'web']);
        $create_division = Permission::create(['name' => 'create-division' , 'modul_id' => $division->id, 'guard_name' => 'web']);
        $update_division = Permission::create(['name' => 'update-division' , 'modul_id' => $division->id,'guard_name' => 'web']);
        $delete_division = Permission::create(['name' => 'delete-division' , 'modul_id' => $division->id, 'guard_name' => 'web']);

        $read_company = Permission::create(['name' => 'read-company' , 'modul_id' => $company->id, 'guard_name' => 'web']);
        $create_company = Permission::create(['name' => 'create-company' , 'modul_id' => $company->id, 'guard_name' => 'web']);
        $update_company = Permission::create(['name' => 'update-company' , 'modul_id' => $company->id,'guard_name' => 'web']);
        $delete_company = Permission::create(['name' => 'delete-company' , 'modul_id' => $company->id, 'guard_name' => 'web']);

        $read_position = Permission::create(['name' => 'read-position' , 'modul_id' => $position->id, 'guard_name' => 'web']);
        $create_position = Permission::create(['name' => 'create-position' , 'modul_id' => $position->id, 'guard_name' => 'web']);
        $update_position = Permission::create(['name' => 'update-position' , 'modul_id' => $position->id,'guard_name' => 'web']);
        $delete_position = Permission::create(['name' => 'delete-position' , 'modul_id' => $position->id, 'guard_name' => 'web']);

        $read_employee = Permission::create(['name' => 'read-employee' , 'modul_id' => $employee->id, 'guard_name' => 'web']);
        $create_employee = Permission::create(['name' => 'create-employee' , 'modul_id' => $employee->id, 'guard_name' => 'web']);
        $update_employee = Permission::create(['name' => 'update-employee' , 'modul_id' => $employee->id,'guard_name' => 'web']);
        $delete_employee = Permission::create(['name' => 'delete-employee' , 'modul_id' => $employee->id, 'guard_name' => 'web']);

        $user_management = Permission::create(['name' => 'read-user-management' , 'modul_id' => $master->id,'guard_name' => 'web']);
        $master_data = Permission::create(['name' => 'read-master-data' , 'modul_id' => $master->id, 'guard_name' => 'web']);
        $master_data = Permission::create(['name' => 'read-dashboard' , 'modul_id' => $master->id, 'guard_name' => 'web']);

        $read_permission = Permission::create(['name' => 'read-permission' ,'modul_id' => $permission->id, 'guard_name' => 'web']);
        $create_permission = Permission::create(['name' => 'create-permission' ,'modul_id' => $permission->id, 'guard_name' => 'web']);
        $update_permission = Permission::create(['name' => 'update-permission' ,'modul_id' => $permission->id, 'guard_name' => 'web']);
        $delete_permission = Permission::create(['name' => 'delete-permission' ,'modul_id' => $permission->id, 'guard_name' => 'web']);

        $read_user = Permission::create(['name' => 'read-user' ,'modul_id' => $user->id,'guard_name' => 'web']);
        $create_user = Permission::create(['name' => 'create-user' ,'modul_id' => $user->id, 'guard_name' => 'web']);
        $update_user = Permission::create(['name' => 'update-user' ,'modul_id' => $user->id,'guard_name' => 'web']);
        $delete_user = Permission::create(['name' => 'delete-user' ,'modul_id' => $user->id,'guard_name' => 'web']);
    }
}
