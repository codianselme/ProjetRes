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
        $roles = [
            [#1
                'name' => 'Super Admin',
                'guard_name' => 'web',
                // 'description' => "C'est le super administrateur de la plateforme. Il a accès a tous les module et fonctionnalité.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#2
                'name' => 'Admin',
                'guard_name' => 'web',
                // 'description' => "Il représente un administrateur de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#3
                'name' => 'Gestionnaire',
                'guard_name' => 'web',
                // 'description' => "Ce role représente un gestionnaire de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#4
                'name' => 'Caissière',
                'guard_name' => 'web',
                // 'description' => "Ce role représente une Caissière de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#5
                'name' => 'Serveur',
                'guard_name' => 'web',
                // 'description' => "Ce role répresente un serveur de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#6
                'name' => 'Employee',
                'guard_name' => 'web',
                // 'description' => "Ce role répresente un employee de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#7
                'name' => 'Gérante',
                'guard_name' => 'web',
                // 'description' => "Ce role répresente un employee de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [#8
                'name' => 'Comercial',
                'guard_name' => 'web',
                // 'description' => "Ce role répresente un employee de l'application.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];
        Role::insert($roles);
    }
}
