<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = [
            [
                'name' => 'Salade César',
                'description' => 'Salade verte avec du poulet grillé, des croûtons, du parmesan et une sauce César maison.',
                'price' => 1000,
                // 'category_id' => 1, // Exemple: 1 est l'ID de la catégorie des légumes, à ajuster selon vos données
                'is_available' => true
            ],
            [
                'name' => 'Pizza Margherita',
                'description' => 'Pizza classique avec sauce tomate, mozzarella, basilic frais et huile d\'olive.',
                'price' => 8000,
                // 'category_id' => 2, // Exemple: 2 est l'ID de la catégorie des pains, à ajuster selon vos données
                'is_available' => true
            ],
            [
                'name' => 'Steak Frites',
                'description' => 'Steak de bœuf grillé accompagné de frites maison et de légumes de saison.',
                'price' => 800,
                // 'category_id' => 3, // Exemple: 3 est l'ID de la catégorie des viandes, à ajuster selon vos données
                'is_available' => true
            ],
            [
                'name' => 'Sushi Assortiment',
                'description' => 'Assortiment de sushi avec saumon, thon, avocat et riz vinaigré.',
                'price' => 1500,
                // 'category_id' => 4, // Exemple: 4 est l'ID de la catégorie des poissons, à ajuster selon vos données
                'is_available' => true
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Dessert italien à base de mascarpone, café, cacao et biscuits savoiardi.',
                'price' => 2000,
                // 'category_id' => 5, // Exemple: 5 est l'ID de la catégorie des fruits de mer (pour le dessert, ajustez cela en fonction de vos catégories)
                'is_available' => true
            ],
        ];

        // Insertion des plats dans la table dishes
        Dish::insert($dishes);
    }
}
