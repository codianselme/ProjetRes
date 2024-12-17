<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $dishes_liste = [
            [
                'name' => 'Pâte + Crin-crin + Friture',
                'description' => 'Plat composé de pâte, crin-crin et friture de viande ou poisson.',
                'price' => 3000,
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée + Sauces (Claire & arachide)',
                'description' => 'Igname pilée servi avec une sauce claire et une sauce arachide.',
                'price' => 3000,
                'is_available' => 1,
            ],
            [
                'name' => 'Poisson braisé',
                'description' => 'Poisson braisé à la perfection, servi avec un accompagnement au choix.',
                'price' => 4000,
                'is_available' => 1,
            ],
            [
                'name' => 'Poulet braisé',
                'description' => 'Poulet braisé, tendre et savoureux, accompagné d\'un plat d\'accompagnement.',
                'price' => 4000,
                'is_available' => 1,
            ],
            [
                'name' => 'Pintade braisée',
                'description' => 'Pintade braisée avec une marinade spéciale, servie avec des accompagnements.',
                'price' => 4000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: Riz',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: Aloko',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: Frite d\'igname',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: pomme frite',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: pomme à vapeur',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: pomme sautée',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
            [
                'name' => 'Accompagnements: Cous-cous blanc',
                'description' => 'Accompagnements variés pour compléter vos plats principaux.',
                'price' => 1000,
                'is_available' => 1,
            ],
        ];
        // Insertion dans la table drink_supplies
        DB::table('dishes')->insert($dishes_liste);
    }
}
