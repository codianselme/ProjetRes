<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données d'exemple pour les catégories d'aliments
        $categories = [
            ['name' => 'Légumes', 'description' => 'Aliments d\'origine végétale, souvent utilisés en accompagnement ou en salade, comme les carottes, tomates, épinards, etc.'],
            ['name' => 'Fruits', 'description' => 'Aliments sucrés ou acides provenant de plantes, généralement consommés frais, comme les pommes, bananes, oranges, etc.'],
            ['name' => 'Viandes', 'description' => 'Protéines animales provenant d\'animaux terrestres ou marins, comme le bœuf, le poulet, le porc, etc.'],
            ['name' => 'Poissons', 'description' => 'Produits comestibles provenant de poissons d\'eau douce ou salée, comme le saumon, le thon, la truite, etc.'],
            ['name' => 'Fruits de mer', 'description' => 'Produits comestibles provenant de la mer, tels que les crevettes, huîtres, moules, crabes, etc.'],
            ['name' => 'Épices', 'description' => 'Substances aromatiques utilisées pour parfumer et assaisonner les plats, telles que le poivre, le curcuma, le cumin, etc.'],
            ['name' => 'Condiments', 'description' => 'Ingrédients utilisés pour ajouter du goût aux repas, comme la moutarde, le vinaigre, le ketchup, la mayonnaise, etc.'],
            ['name' => 'Pains et Produits de Boulangerie', 'description' => 'Produits à base de farine, levure et eau, comme les pains, baguettes, brioches, pâtisseries, etc.'],
            ['name' => 'Produits Laitiers', 'description' => 'Aliments issus du lait, tels que le lait, le fromage, le beurre, le yaourt, etc.'],
            ['name' => 'Céréales et Grains', 'description' => 'Produits dérivés de céréales, comme le blé, le maïs, l\'avoine, le quinoa, etc., souvent utilisés comme base pour les repas.'],
            ['name' => 'Huiles', 'description' => 'Graisses liquides extraites de plantes ou d\'animaux, utilisées pour la cuisson ou comme assaisonnement, comme l\'huile d\'olive, de tournesol, de coco, etc.'],
            ['name' => 'Légumes', 'description' => 'Aliments végétaux consommés pour leur haute teneur en vitamines et minéraux, comme les courgettes, épinards, poivrons, etc.'],
            ['name' => 'Riz', 'description' => 'Céréale largement consommée dans le monde, utilisée comme accompagnement ou base de plats, comme le riz basmati, riz blanc, riz complet, etc.'],
            ['name' => 'Pâtes', 'description' => 'Produit de farine de blé, souvent utilisé dans des plats italiens comme les spaghettis, les penne, les raviolis, etc.'],
            ['name' => 'Pommes de Terre', 'description' => 'Légume féculent utilisé dans de nombreuses préparations, telles que les frites, purée, gratins, etc.'],
        ];

        // Insertion des catégories dans la table food_categories
        DB::table('food_categories')->insert($categories);
    }
}