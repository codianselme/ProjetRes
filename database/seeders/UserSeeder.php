<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'CODI', 
                'last_name' => 'Anselme', 
                'name' => 'Codi Anselme', 
                'contact' => '96865200', 
                'poste' => 'Ingénieur Informatique', 
                'email' => 'codianselme@gmail.com', 
                'password' => bcrypt('codianselme@gmail.com'), 
                'gender' => 'Masculin', 
                'address' => 'Ab-Calavi', 
                'status' => true,
                'role' => 'Super Admin'
            ],
            // [
            //     'first_name' => 'Sylvie', 
            //     'last_name' => 'Dupont', 
            //     'name' => 'Sylvie Dupont', 
            //     'contact' => '0123456789', 
            //     'poste' => 'Serveuse', 
            //     'email' => 'serveuse@lessaveursducoridor.com', 
            //     'password' => bcrypt('serveuse@lessaveursducoridor.com'), 
            //     'gender' => 'Feminin', 
            //     'address' => 'Paris', 
            //     'status' => true,
            //     'role' => 'Serveur'
            // ],
            // [
            //     'first_name' => 'Jean', 
            //     'last_name' => 'Pierre', 
            //     'name' => 'Jean Pierre', 
            //     'contact' => '0987654321', 
            //     'poste' => 'Cuisinier', 
            //     'email' => 'cuisinier@lessaveursducoridor.com', 
            //     'password' => bcrypt('cuisinier@lessaveursducoridor.com'), 
            //     'gender' => 'Masculin', 
            //     'address' => 'Lyon', 
            //     'status' => true,
            //     'role' => 'Cuisinier'
            // ],
            // [
            //     'first_name' => 'Marie', 
            //     'last_name' => 'Lefebvre', 
            //     'name' => 'Marie Lefebvre', 
            //     'contact' => '0112233445', 
            //     'poste' => 'Caissière', 
            //     'email' => 'caissiere@lessaveursducoridor.com', 
            //     'password' => bcrypt('caissiere@lessaveursducoridor.com'), 
            //     'gender' => 'Feminin', 
            //     'address' => 'Marseille', 
            //     'status' => true,
            //     'role' => 'Caissière'
            // ],
            // [
            //     'first_name' => 'Sophie', 
            //     'last_name' => 'Martin', 
            //     'name' => 'Sophie Martin', 
            //     'contact' => '0223344556', 
            //     'poste' => 'Gérante', 
            //     'email' => 'gerante@lessaveursducoridor.com', 
            //     'password' => bcrypt('gerante@lessaveursducoridor.com'), 
            //     'gender' => 'Féminin', 
            //     'address' => 'Bordeaux', 
            //     'status' => true,
            //     'role' => 'Gérante'
            // ],

            [
                'first_name' => 'KPEHOUN', 
                'last_name' => 'Kenneth', 
                'name' => 'KPEHOUN Kenneth', 
                'contact' => '0196000000', 
                'poste' => 'Admin', 
                'email' => 'kpehounkenneth@gmail.com', 
                'password' => bcrypt('kpehounkenneth@gmail.com'), 
                'gender' => 'Masculin', 
                'address' => 'Cotonou', 
                'status' => true,
                'role' => 'Admin'
            ],

            [
                'first_name' => 'YETONDJI', 
                'last_name' => 'S', 
                'name' => 'S YETONDJI', 
                'contact' => '0196000000', 
                'poste' => 'Admin', 
                'email' => 'syetondji@yahoo.fr', 
                'password' => bcrypt('syetondji@yahoo.fr'), 
                'gender' => 'Masculin', 
                'address' => 'Cotonou', 
                'status' => true,
                'role' => 'Admin'
            ],

            [
                'first_name' => 'SOSSOU', 
                'last_name' => 'Egy', 
                'name' => 'SOSSOU Egy', 
                'contact' => '0196000000', 
                'poste' => 'Admin', 
                'email' => 'egysossou@gmail.com', 
                'password' => bcrypt('egysossou@gmail.com'), 
                'gender' => 'Masculin', 
                'address' => 'Cotonou', 
                'status' => true,
                'role' => 'Admin'
            ],

            [
                'first_name' => 'MBAREDOUN', 
                'last_name' => 'Gloria', 
                'name' => 'Mbaredoun Gloria', 
                'contact' => '0196000000', 
                'poste' => 'Gérante', 
                'email' => 'mbaredoungloria@gmail.com', 
                'password' => bcrypt('mbaredoungloria@gmail.com'), 
                'gender' => 'Feminin', 
                'address' => 'Cotonou', 
                'status' => true,
                'role' => 'Gérante'
            ],
        ];

        foreach ($users as $value) {
            // Vérifier si l'utilisateur existe déjà par e-mail
            $user = User::updateOrCreate(
                ['email' => $value['email']], // Condition de recherche
                [
                    'first_name' => $value['first_name'],
                    'last_name'  => $value['last_name'],
                    'name'      => $value['name'],
                    'contact'   => $value['contact'],
                    'poste'     => $value['poste'],
                    'password'  => $value['password'],
                    'gender'    => $value['gender'],
                    'status'    => $value['status'],
                    'address'   => $value['address'],
                ]
            );
            // Assigner le rôle à l'utilisateur
            $user->assignRole($value['role']);
        }
    }
}
