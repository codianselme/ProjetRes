<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrinkCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données d'exemple pour les catégories de boissons
        $categories = [
            ['name' => 'Sodas', 'description' => 'Boissons gazeuses sucrées, souvent aromatisées, telles que cola, limonade, orangeade, etc.'],
            ['name' => 'Eau Minerale', 'description' => 'Eaux minérales, de source ou distillées, plates ou gazeuses, consommées pour leur hydratation.'],
            ['name' => 'Vins', 'description' => 'Boisson alcoolisée obtenue par fermentation de raisins, de fruits ou d\'autres plantes.'],
            ['name' => 'Jus', 'description' => 'Boissons non alcoolisées, souvent à base de fruits ou de légumes, pressés ou extraits.'],
            ['name' => 'Alcools', 'description' => 'Boissons contenant de l\'alcool, comme les spiritueux (whisky, rhum, vodka, etc.) et liqueurs.'],
            ['name' => 'Bières', 'description' => 'Boisson alcoolisée obtenue par fermentation de céréales (principalement de l\'orge), souvent gazéifiée.'],
            ['name' => 'Sucreries', 'description' => 'Boissons sucrées comme les sodas, les sirops, et autres boissons sucrées non alcoolisées.'],
            ['name' => 'Cafés', 'description' => 'Boisson chaude préparée à partir de grains de café moulus, généralement servie avec ou sans lait.'],
            ['name' => 'Thés', 'description' => 'Infusion de feuilles de thé, qui peut être servi chaud ou froid, sucré ou non.'],
        ];

        // Insertion des catégories dans la table drink_categories
        DB::table('drink_categories')->insert($categories);
    }
}
