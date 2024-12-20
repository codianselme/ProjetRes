<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DishCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données d'exemple pour les catégories de boissons
        $categories = [
            [
                'name' => 'Igname Pilée', 
                'description' => 'Igname pilée servi avec une sauce claire et une sauce arachide.'
            ],
            [
                'name' => 'Sauces feuille', 
                'description' => 'Sauces à base de feuilles, souvent utilisées comme accompagnement.'
            ],
            [
                'name' => 'Sauce Gluente', 
                'description' => 'Sauce épaisse et visqueuse, souvent utilisée pour accompagner les plats.'
            ],
            [
                'name' => 'Riz', 
                'description' => 'Céréale de base dans de nombreuses cuisines, souvent servie en accompagnement.'
            ],
            [
                'name' => 'Autres Résistances', 
                'description' => 'Plats à base de céréales ou de tubercules, souvent servis en accompagnement.'
            ],
            [
                'name' => 'Accompagnement', 
                'description' => 'Plats servis en accompagnement des plats principaux.'
            ],
            [
                'name' => 'Viandes et Poissons', 
                'description' => 'Plats principaux à base de viande ou de poisson.'
            ],
            [
                'name' => 'Salades', 
                'description' => 'Plats froids à base de légumes, souvent servis en entrée ou en accompagnement.'
            ],
            [
                'name' => 'Les steaks', 
                'description' => 'Plats principaux à base de viande, souvent grillés.'
            ],
            [
                'name' => 'Nos sauces', 
                'description' => 'Sauces maison, souvent utilisées pour accompagner les plats.'
            ],
            [
                'name' => 'Fast Food', 
                'description' => 'Plats préparés rapidement, souvent servis dans des restaurants à service rapide.'
            ],
            [
                'name' => 'Coocktail', 
                'description' => 'Boissons mélangées, souvent servies lors de réceptions ou de fêtes.'
            ],
            [
                'name' => 'Déserts', 
                'description' => 'Plats sucrés, souvent servis à la fin d\'un repas.'
            ],
        ];

        // Insertion des catégories dans la table dish_categories
        DB::table('dish_categories')->insert($categories);
    }
}
