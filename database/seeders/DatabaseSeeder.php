<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Step 1: Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Step 2: Create Admin Permissions
        $adminPermissions = [
            'view-orders',
            'edit-orders',
            'delete-orders',
            'approve-orders',
            'manage-painters',
            'manage-suppliers',
        ];

        foreach ($adminPermissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $adminRole->permissions()->syncWithoutDetaching($permission->id);
        }

        // Step 3: Create Customer Permission
        $customerPermission = Permission::firstOrCreate(['name' => 'place-order']);
        $customerRole->permissions()->syncWithoutDetaching($customerPermission->id);

        // Step 4: Assign Roles to Users
        $users = User::all();

        foreach ($users as $index => $user) {
            if ($index === 0) {
                // First user is admin
                $user->roles()->syncWithoutDetaching([$adminRole->id]);
            } else {
                // All others are customers
                $user->roles()->syncWithoutDetaching([$customerRole->id]);
            }
        }
    }
}
