<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $AdminRole = Role::create(['name' => 'Admin']);
        $UserRole = Role::create(['name' => 'User']);

        $Permission = Permission::create(['name' => 'manage transactions']);
        $AdminRole->givePermissionTo($Permission);
    }
}
