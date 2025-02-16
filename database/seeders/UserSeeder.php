<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $pembeliRole = Role::firstOrCreate(['name' => 'pembeli']);
        $penjualRole = Role::firstOrCreate(['name' => 'penjual']);

        // Membuat Permission
        $dashboardPermission = Permission::firstOrCreate(['name' => 'dashboard']);
        $adminRole->givePermissionTo($dashboardPermission);

        $pembeliDashboardPermission = Permission::firstOrCreate(['name' => 'dashboard pembeli']);
        $pembeliRole->givePermissionTo($pembeliDashboardPermission);

        $penjualDashboardPermission = Permission::firstOrCreate(['name' => 'dashboard penjual']);
        $penjualRole->givePermissionTo($penjualDashboardPermission);

        // Membuat User dengan Role
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Cari berdasarkan email
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        )->assignRole('admin');

        User::updateOrCreate(
            ['email' => 'pembeli@example.com'], // Cari berdasarkan email
            [
                'name' => 'Pembeli',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ]
        )->assignRole('pembeli');

        User::updateOrCreate(
            ['email' => 'penjual@example.com'], // Cari berdasarkan email
            [
                'name' => 'Penjual',
                'password' => Hash::make('password'),
                'role' => 'penjual',
            ]
        )->assignRole('penjual');
    }
}
