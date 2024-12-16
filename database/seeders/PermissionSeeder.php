<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            # Dashbord de la direction
            ['name' => 'direction_menu_gestion_des_utilisateurs', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_sous_menu_permissions', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_creer_des_permissions', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_details_permissions', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_modifier_permissions', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_supprimer_permissions', 'guard_name' => 'web', /* 'description' => '' */],

            ['name' => 'direction_sous_menu_profile_utilisateurs', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_creer_des_profiles_utilisateurs', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_details_profile', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_modifier_profile', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_supprimer_profile', 'guard_name' => 'web', /* 'description' => '' */],

            ['name' => 'direction_sous_menu_utilisateurs', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_creer_un_utilisateur', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_details_utilisateur', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_modifier_utilisateur', 'guard_name' => 'web', /* 'description' => '' */],
            ['name' => 'direction_archiver_utilisateur', 'guard_name' => 'web', /* 'description' => '' */],
        ];

        foreach ($permissions as $key => $value) {
            // dump($value);
            Permission::create([
                'name'        => $value['name'],
                'guard_name'  => $value['guard_name'],
                // 'description' => $value['description'],
            ]);
        }
    }
}
