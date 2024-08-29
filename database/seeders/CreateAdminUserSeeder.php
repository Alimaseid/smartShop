<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.

     *

     * @return void
     */
    public function run()
{
    // Create the admin user
    $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin123'),
    ]);

    // Create roles
    $adminRole = Role::create(['name' => 'Admin']);

    // Get all permissions
    $permissions = Permission::pluck('name')->all();

    // Assign all permissions to the Admin role
    $adminRole->givePermissionTo($permissions);



    // Assign roles to the admin user
    $user->assignRole($adminRole);
}

}
