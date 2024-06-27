<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $employee = Role::create(['name' => 'employee']);
        $customer = Role::create(['name' => 'customer']);

        $permissions = [
            //users
            'view users',
            'create users',
            'edit users',
            'delete users',

            //products
            'view products',
            'create products',
            'edit products',
            'delete products',

            //categories
            'view categories',
            'create categories',
            'edit categories',
            'delete categories'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin->givePermissionTo(Permission::all());

        $employee->givePermissionTo([
            'view users', 'edit users',
            'view products', 'edit products',
            'view categories', 'edit categories'
        ]);
    }
}
