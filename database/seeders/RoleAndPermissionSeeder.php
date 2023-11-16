<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Your code to create roles and permissions goes here
        
        // Example:
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);
        
        $createUsersPermission = Permission::create(['name' => 'create users']);
        $editUsersPermission = Permission::create(['name' => 'edit users']);
        
        $adminRole->givePermissionTo($createUsersPermission, $editUsersPermission);
        $teacherRole->givePermissionTo($editUsersPermission);
    }
}

