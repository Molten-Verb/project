<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $seedAdmin = User::create(['name' => 'admin', 'email' => 'admin@mail.com', 'password' => 'admin']);

        $giveRoleToAdmin = User::firstwhere('name', 'admin'); // Найдите пользователя
        $giveRoleToAdmin->assignRole('admin'); // Назначьте роль админа
    }
}
