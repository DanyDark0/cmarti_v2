<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Editor']);

        Permission::create(['name' => 'Visualizar usuarios'])->assignRole($role1);
        Permission::create(['name' => 'Crear usuario'])->assignRole($role1);
        Permission::create(['name' => 'Eliminar usuario'])->assignRole($role1);

        Permission::create(['name' => 'Crear actividad'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Editar actividad'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar actividad'])->syncRoles([$role1]);

        Permission::create(['name' => 'Eliminar documentos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Crear convocatoria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Editar convocatoria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar convocatorias'])->syncRoles([$role1]);

        Permission::create(['name' => 'Subir archivo convocatoria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Actualizar archivo convocatoria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar archivo convocatoria'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'Crear galeria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Editar galeria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar galerias'])->syncRoles([$role1]);

        Permission::create(['name' => 'Subir foto galeria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Actualizar foto galeria'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar foto galeria'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'Crear directorio'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Editar directorio'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'Eliminar directorio'])->syncRoles([$role1]);

        // Crear usuario de prueba con el rol "Admin"
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Evita duplicados
            [
                'name' => 'Daniel Guzman',
                'password' => bcrypt('87654321')
            ]
        );

        // Asignar el rol "Admin" al usuario
        if (!$user->hasRole('Admin')) {
            $user->assignRole($role1);
            $this->command->info('✅ Usuario de prueba creado y asignado al rol "Admin".');
        } else {
            $this->command->info('🔹 El usuario ya tenía el rol "Admin".');
        }

        $us = User::firstOrCreate(
            ['email' => 'editor_catedra@gmail.com'], // Evita duplicados
            [
                'name' => 'Aquiles Brinco',
                'password' => bcrypt('87654321')
            ]
        );

        // Asignar el rol "Admin" al usuario
        if (!$us->hasRole('Editor')) {
            $us->assignRole($role2);
            $this->command->info('✅ Usuario de prueba creado y asignado al rol "Editor".');
        } else {
            $this->command->info('🔹 El usuario ya tenía el rol "Editor".');
        }
    }
    }

