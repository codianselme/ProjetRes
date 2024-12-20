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
                'status' => true
            ],

            [
                'first_name' => 'METCHONHOUN', 
                'last_name' => 'Marius', 
                'name' => 'METCHONHOUN Marius', 
                'contact' => '0197000000', 
                'poste' => 'Commercial', 
                'email' => 'mariooneday@gmail.com', 
                'password' => bcrypt('mariooneday@gmail.com'), 
                'gender' => 'Masculin', 
                'address' => 'Ab-Calavi', 
                'status' => true
            ],

            [
                'first_name' => 'MBAREDOUN', 
                'last_name' => 'Gloria', 
                'name' => 'MBAREDOUN Gloria', 
                'contact' => '0196000000', 
                'poste' => 'Gérante', 
                'email' => 'lessaveursducorridor@gmail.com', 
                'password' => bcrypt('lessaveursducorridor@gmail.com'), 
                'gender' => 'Féminin', 
                'address' => 'Ab-Calavi', 
                'status' => true
            ],
        ];

        foreach ($users as $key => $value) {
            // dump($value);
            $user = User::create([
                'first_name' => $value['first_name'],
                'last_name'  => $value['last_name'],
                'name'      => $value['name'],
                'contact'   => $value['contact'],
                'poste'     => $value['poste'],
                'email'     => $value['email'],
                'password'  => $value['password'],
                'gender'    => $value['gender'],
                'status'    => $value['status'],
                'address'   => $value['address'],
            ]);
            $user->assignRole('Admin');
        }
    }
}
