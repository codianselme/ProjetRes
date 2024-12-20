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
        
        // $dishes_liste = [
        //     [
        //         'name' => 'Pâte + Crin-crin + Friture',
        //         'description' => 'Plat composé de pâte, crin-crin et friture de viande ou poisson.',
        //         'price' => 3000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Igname pilée + Sauces (Claire & arachide)',
        //         'description' => 'Igname pilée servi avec une sauce claire et une sauce arachide.',
        //         'price' => 3000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Poisson braisé',
        //         'description' => 'Poisson braisé à la perfection, servi avec un accompagnement au choix.',
        //         'price' => 4000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Poulet braisé',
        //         'description' => 'Poulet braisé, tendre et savoureux, accompagné d\'un plat d\'accompagnement.',
        //         'price' => 4000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Pintade braisée',
        //         'description' => 'Pintade braisée avec une marinade spéciale, servie avec des accompagnements.',
        //         'price' => 4000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: Riz',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: Aloko',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: Frite d\'igname',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: pomme frite',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: pomme à vapeur',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: pomme sautée',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        //     [
        //         'name' => 'Accompagnements: Cous-cous blanc',
        //         'description' => 'Accompagnements variés pour compléter vos plats principaux.',
        //         'price' => 1000,
        //         'is_available' => 1,
        //     ],
        // ];












        $dishes_liste = [
            // IGNAME PILEE
            [
                'name' => 'Igname pilée sauce claire mouton',
                'description' => 'Igname pilée servie avec une sauce claire à base de mouton.',
                'price' => 3000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce claire poulet',
                'description' => 'Igname pilée servie avec une sauce claire à base de poulet.',
                'price' => 3000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce claire agouti',
                'description' => 'Igname pilée servie avec une sauce claire à base d\'agouti.',
                'price' => 8000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce claire pintades',
                'description' => 'Igname pilée servie avec une sauce claire à base de pintades.',
                'price' => 8000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce arachide mouton',
                'description' => 'Igname pilée servie avec une sauce à l\'arachide et du mouton.',
                'price' => 3000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce arachide poulet',
                'description' => 'Igname pilée servie avec une sauce à l\'arachide et du poulet.',
                'price' => 3000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce graines poisson Filet',
                'description' => 'Igname pilée servie avec une sauce aux graines et du poisson Filet.',
                'price' => 3500,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce graines agouti',
                'description' => 'Igname pilée servie avec une sauce aux graines et de l\'agouti.',
                'price' => 8000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée sauce graines pintades',
                'description' => 'Igname pilée servie avec une sauce aux graines et de pintades.',
                'price' => 8000,
                'category_id' => 1, 
                'is_available' => 1,
            ],
            // Sauces feuille
            [
                'name' => 'Gboman poisson',
                'description' => 'Gboman servie avec du poisson.',
                'price' => 3000,
                'category_id' => 2, // Assurez-vous que l'ID de catégorie est correct
                'is_available' => 1,
            ],
            [
                'name' => 'Gboman mouton',
                'description' => 'Gboman servie avec du mouton.',
                'price' => 3000,
                'category_id' => 2, // Assurez-vous que l'ID de catégorie est correct
                'is_available' => 1,
            ],
            [
                'name' => 'Gboman agouti',
                'description' => 'Gboman servie avec de l\'agouti.',
                'price' => 6000,
                'category_id' => 2,
                'is_available' => 1,
            ],
            [
                'name' => 'Sauce égoussi poisson',
                'description' => 'Sauce égoussi servie avec du poisson.',
                'price' => 4500,
                'category_id' => 2,
                'is_available' => 1,
            ],
            [
                'name' => 'Sauce égoussi mouton',
                'description' => 'Sauce égoussi servie avec du mouton.',
                'price' => 4500,
                'category_id' => 2,
                'is_available' => 1,
            ],

            // Sauce Gluente
            [
                'name' => 'Sauce assrorkouin',
                'description' => 'Sauce assrorkouin.',
                'price' => 4500,
                'category_id' => 3,
                'is_available' => 1,
            ],
            [
                'name' => 'Sauces gluante adémin',
                'description' => 'Sauces gluante adémin.',
                'price' => 3000,
                'category_id' => 3,
                'is_available' => 1,
            ],

            // Riz
            [
                'name' => 'Riz au poulet + frites',
                'description' => 'Riz servi avec du poulet et des frites.',
                'price' => 4000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz aux légumes au poulet',
                'description' => 'Riz servi avec des légumes et du poulet.',
                'price' => 3500,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz au poisson frite',
                'description' => 'Riz servi avec du poisson frit.',
                'price' => 4000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz au poisson aloko',
                'description' => 'Riz servi avec du poisson et de l\'aloko.',
                'price' => 4000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz au poulet aloko',
                'description' => 'Riz servi avec du poulet et de l\'aloko.',
                'price' => 5000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz au poulet frites',
                'description' => 'Riz servi avec du poulet et des frites.',
                'price' => 5000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Atassi au poisson',
                'description' => 'Atassi servi avec du poisson.',
                'price' => 3000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz au pilaf au poulet',
                'description' => 'Riz servi avec du pilaf et du poulet.',
                'price' => 4000,
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (bœuf)',
                'description' => 'Fried rice servi avec du bœuf.',
                'price' => 3000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (poulet)',
                'description' => 'Fried rice servi avec du poulet.',
                'price' => 3000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (crevette)',
                'description' => 'Fried rice servi avec des crevettes.',
                'price' => 3000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (bœuf)',
                'description' => 'Fried rice servi avec du bœuf.',
                'price' => 4000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (poulet)',
                'description' => 'Fried rice servi avec du poulet.',
                'price' => 4000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (crevette)',
                'description' => 'Fried rice servi avec des crevettes.',
                'price' => 4000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (bœuf)',
                'description' => 'Fried rice servi avec du bœuf.',
                'price' => 5000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (poulet)',
                'description' => 'Fried rice servi avec du poulet.',
                'price' => 5000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            [
                'name' => 'Fried rice (crevette)',
                'description' => 'Fried rice servi avec des crevettes.',
                'price' => 5000, // prix pour bœuf
                'category_id' => 4,
                'is_available' => 1,
            ],
            // [
            //     'name' => 'Fried rice (bœuf, poulet, crevette)',
            //     'description' => 'Fried rice servi avec du bœuf, du poulet et des crevettes.',
            //     'price' => 4000, // prix pour poulet
            //     'category_id' => 4,
            //     'is_available' => 1,
            // ],
            // [
            //     'name' => 'Fried rice (bœuf, poulet, crevette)',
            //     'description' => 'Fried rice servi avec du bœuf, du poulet et des crevettes.',
            //     'price' => 5000, // prix pour crevette
            //     'category_id' => 4,
            //     'is_available' => 1,
            // ],
            
            // Autres résistances
            [
                'name' => 'Amiwo au poulet',
                'description' => 'Amiwo servi avec du poulet.',
                'price' => 4000,
                'category_id' => 5, 
                'is_available' => 1,
            ],
            [
                'name' => 'Akassa et monyo au poisson',
                'description' => 'Akassa et monyo servi avec du poisson.',
                'price' => 3500,
                'category_id' => 5,
                'is_available' => 1,
            ],
            [
                'name' => 'Êba et monyo au poisson',
                'description' => 'Êba et monyo servi avec du poisson.',
                'price' => 3500,
                'category_id' => 5,
                'is_available' => 1,
            ],
            [
                'name' => 'Atiékè au poisson bar',
                'description' => 'Atiékè servi avec du poisson bar.',
                'price' => 5000,
                'category_id' => 5,
                'is_available' => 1,
            ],
            [
                'name' => 'Atiékè au poisson tilapia',
                'description' => 'Atiékè servi avec du poisson tilapia.',
                'price' => 5000,
                'category_id' => 5,
                'is_available' => 1,
            ],
            [
                'name' => 'Kpètè au mouton Piron',
                'description' => 'Kpètè servi avec du mouton Piron.',
                'price' => 3000,
                'category_id' => 5,
                'is_available' => 1,
            ],
            [
                'name' => 'Kpètè au mouton Akassa',
                'description' => 'Kpètè servi avec du mouton Akassa.',
                'price' => 3000,
                'category_id' => 5,
                'is_available' => 1,
            ],

            // Accompagnement
            [
                'name' => 'Pâte maïs',
                'description' => 'Pâte de maïs.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Télibo',
                'description' => 'Télibo.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Akassa',
                'description' => 'Akassa.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Agbéli',
                'description' => 'Agbéli.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Igname pilée',
                'description' => 'Igname pilée.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Pommes de terre sautées',
                'description' => 'Pommes de terre sautées.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Piron',
                'description' => 'Piron.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Couscous',
                'description' => 'Couscous.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Riz',
                'description' => 'Riz.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Frites',
                'description' => 'Frites.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Alloco',
                'description' => 'Alloco.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],
            [
                'name' => 'Igame frit',
                'description' => 'Igame frit.',
                'price' => 1000,
                'category_id' => 6,
                'is_available' => 1,
            ],

            // Viandes et Poissons
            [
                'name' => 'Poisson braisé',
                'description' => 'Poisson braisé.',
                'price' => 5000,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Poisson pané',
                'description' => 'Poisson pané.',
                'price' => 4500,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Poulet braisé entier (bicyclette)',
                'description' => 'Poulet braisé entier (bicyclette).',
                'price' => 9000,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => '½ Poulet braisé (bicyclette)',
                'description' => '½ Poulet braisé (bicyclette).',
                'price' => 4500,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Poulet braisé (poulet chaire)',
                'description' => 'Poulet braisé (poulet chaire).',
                'price' => 7000,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Brochettes de mouton',
                'description' => 'Brochettes de mouton.',
                'price' => 2000,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Brochettes de gésiers',
                'description' => 'Brochettes de gésiers grillées à la perfection, servies avec une sauce de votre choix.',
                'price' => 1500,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Saucisse braisée',
                'description' => 'Saucisse braisée dans une sauce savoureuse, accompagnée de légumes frais.',
                'price' => 1000,
                'category_id' => 7,
                'is_available' => 1,
            ],
            [
                'name' => 'Aileron braisé',
                'description' => 'Aileron de poulet braisé dans une sauce riche et épicée, servi avec du riz ou des légumes.',
                'price' => 3000,
                'category_id' => 7,
                'is_available' => 1,
            ],
        ];


        // Insertion dans la table drink_supplies
        DB::table('dishes')->insert($dishes_liste);
    }
}
