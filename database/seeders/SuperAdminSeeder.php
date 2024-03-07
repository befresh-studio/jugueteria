<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Administrador', 
            'email' => 'superadmin@jugueterianodejesdesoñar.es',
            'password' => Hash::make('superadmin1234')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Administrador', 
            'email' => 'admin@jugueterianodejesdesoñar.es',
            'password' => Hash::make('admin1234')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $jugueteManager = User::create([
            'name' => 'Gestor juguetes', 
            'email' => 'gestor@jugueterianodejesdesoñar.es',
            'password' => Hash::make('gestor1234')
        ]);
        $jugueteManager->assignRole('Gestor juguetes');
    }
}
