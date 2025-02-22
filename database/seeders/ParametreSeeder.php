<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParametreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parametres')->insert([
            'type'            => 'BAR RESTAURANT', // Nom du restaurant ou de la structure
            'name'            => 'LES SAVEURS DU CORRIDOR', // Nom du restaurant ou de la structure 
            'address'         => "Fidrossè, 100m à gauche de 'Bénin Atlantic Beach Hotel' en allant vers le CEG Fiyegnon", // Adresse
            'contact_phone_1' => '+229 0151616130', // Numéro de contact
            'contact_phone_2' => '+229 0197918228', // Numéro de contact
            'contact_phone_3' => '+229 0190085807', // Numéro de contact
            'email'           => 'contact@saveursducorridor.com', // Email (facultatif)
            'website'         => 'les-saveurs-du-corridor.com', // Site web (facultatif)
            'description'     => 'Restaurant et bar spécialisé dans les mets locaux et les boissons variées, offrant une expérience gastronomique unique.', // Description
            'facebook'        => '#',
            'twitter'         => '#',
            'instagram'       => '#',
            'youtube'         => '#',
        ]);
    }
}
