<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::findOrFail(1)->roles()->sync(1);

        // Définir les rôles à créer
        $roles = ['Super Admin', 'Admin', 'Gestionnaire', 'Caissière', 'Serveur', 'Gérante', 'Comercial', 'Cuisinier'];

        foreach ($roles as $roleName) {
            // Créer ou récupérer le rôle
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Assigner toutes les permissions au rôle
            $permissions = Permission::all();
            $role->syncPermissions($permissions);
        }
    }
}
