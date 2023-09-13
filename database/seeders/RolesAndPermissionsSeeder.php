<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['guard_name' => 'api', 'name' => 'manager']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@rockstar.com',
            'password' => bcrypt('manager00'),
        ]);
        $user->assignRole($role1);
    }
}
