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
            ['name' => 'Boissons Énergisantes', 'description' => 'Boissons stimulantes contenant de la caféine, taurine et autres substances énergisantes.'],
            ['name' => 'Smoothies', 'description' => 'Boissons mixées à base de fruits, légumes, yaourt ou lait, souvent enrichies en protéines ou superaliments.'],
            ['name' => 'Cocktails', 'description' => 'Mélanges de boissons alcoolisées ou non, avec différents ingrédients et garnitures.'],
            ['name' => 'Boissons Végétales', 'description' => 'Alternatives au lait d\'origine végétale comme le lait d\'amande, de soja, d\'avoine, etc.'],
            ['name' => 'Infusions', 'description' => 'Boissons chaudes préparées par infusion d\'herbes, de fleurs ou de fruits.'],
            ['name' => 'Chocolats Chauds', 'description' => 'Boissons chaudes à base de cacao, pouvant être enrichies de lait, crème ou épices.'],
            ['name' => 'Mocktails', 'description' => 'Cocktails sans alcool, préparés avec des jus, sirops et autres ingrédients non alcoolisés.'],
            ['name' => 'Kombucha', 'description' => 'Boisson fermentée à base de thé, probiotique et légèrement pétillante.'],
            ['name' => 'Cidres', 'description' => 'Boisson alcoolisée ou non, obtenue par fermentation du jus de pomme ou d\'autres fruits.'],
            ['name' => 'Boissons Sportives', 'description' => 'Boissons isotoniques conçues pour l\'hydratation pendant l\'effort physique, enrichies en électrolytes.'],
            ['name' => 'Kéfir', 'description' => 'Boisson fermentée probiotique à base de lait ou d\'eau, riche en probiotiques et nutriments.'],
            ['name' => 'Punch', 'description' => 'Boissons festives à base de fruits et d\'alcool ou non, souvent servies lors d\'événements.'],
            ['name' => 'Lassi', 'description' => 'Boisson traditionnelle indienne à base de yaourt, sucrée ou salée, parfois aromatisée aux fruits.'],
            ['name' => 'Bubble Tea', 'description' => 'Boisson à base de thé originaire de Taïwan, servie avec des perles de tapioca ou autres toppings.'],
            ['name' => 'Champagnes', 'description' => 'Vins effervescents de prestige provenant de la région de Champagne ou vins mousseux similaires.'],
            ['name' => 'Apéritifs', 'description' => 'Boissons alcoolisées servies avant le repas pour stimuler l\'appétit, comme le vermouth ou le pastis.']
        ];

        // Insertion des catégories dans la table drink_categories
        DB::table('drink_categories')->insert($categories);
    }
}
