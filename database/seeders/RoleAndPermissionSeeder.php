<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create-product',
            'delete-product',
            'edit-product',
            'view-products',
            'view-product-detail',
            
            'create-customer',
            'delete-customer',
            'edit-customer',
            'view-customers',
            'view-customer-detail',

            'create-order',
            'delete-order',
            'edit-order',
            'view-orders',
            'view-order-detail',
        ];

        $roles = [
            'loggedUser',
            'manager',
        ];

        foreach ($permissions as $name) {
            Permission::create(['name' => $name]);
        }

        Role::create(['name' => 'loggedUser'])->givePermissionTo([
            'view-customers',
            'view-customer-detail',
            'view-orders',
            'view-order-detail',
            'create-order',
        ]);
        Role::create(['name' => 'manager'])->givePermissionTo(Permission::all());
    }
}
