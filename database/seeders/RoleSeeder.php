<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $jugueteManager = Role::create(['name' => 'Gestor juguetes']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-juguete',
            'edit-juguete',
            'delete-juguete'
        ]);

        $jugueteManager->givePermissionTo([
            'create-juguete',
            'edit-juguete',
            'delete-juguete'
        ]);
    }
}
