<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('structures')->insert([
            'name' => 'Les Saveurs du Corridor', // Nom du restaurant ou de la structure
            'address' => '123 Rue des Saveurs, Cotonou, Bénin', // Adresse
            'contact_phone' => '+229 0151616130', // Numéro de contact
            'email' => 'contact@saveursducorridor.com', // Email (facultatif)
            'website' => 'www.saveursducorridor.com', // Site web (facultatif)
            'description' => 'Restaurant et bar spécialisé dans les mets locaux et les boissons variées, offrant une expérience gastronomique unique.', // Description
        ]);
    }
}
