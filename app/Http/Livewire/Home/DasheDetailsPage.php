<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class DasheDetailsPage extends Component
{
    public $slug;
    public $category;
    public $dishes;

    public function mount($slug)
    {
        $this->slug = $slug;
        $categoryData = $this->getCategoryDetails($slug);
        
        if (!$categoryData) {
            return redirect()->route('home.page');
        }

        $this->category = $categoryData['category'];
        $this->dishes = $categoryData['dishes'];
    }

    private function getCategoryDetails($slug)
    {
        $categories = [
            'igname_pilee' => [
                'category' => [
                    'name' => 'Igname Pilée',
                    'description' => 'Découvrez nos délicieuses préparations d\'igname pilée accompagnées de sauces variées'
                ],
                'dishes' => [
                    [
                        'title' => 'Igname pilée sauce claire mouton/Poulet',
                        'price' => '3000 FCFA',
                        'description' => 'Délicieuse igname pilée servie avec une sauce claire au choix',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Igname pilée sauce claire agouti/Pintades',
                        'price' => '8000 FCFA',
                        'description' => 'Igname pilée avec sauce claire à l\'agouti ou aux pintades',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Igname pilée sauce arachide mouton/Poulet',
                        'price' => '3000 FCFA',
                        'description' => 'Igname pilée servie avec une savoureuse sauce arachide',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Igname pilée sauce d\'arachide agouti/Pintades',
                        'price' => '8000 FCFA',
                        'description' => 'Igname pilée avec sauce arachide à l\'agouti ou aux pintades',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Igname pilée sauce graines poisson Filet',
                        'price' => '3500 FCFA',
                        'description' => 'Igname pilée accompagnée de sauce graines et poisson filet',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Igname pilée sauce graines agouti/Pintades',
                        'price' => '8000 FCFA',
                        'description' => 'Igname pilée avec sauce graines à l\'agouti ou aux pintades',
                        'preparation_time' => '30 minutes'
                    ]
                ]
            ],
            'sauces_feuilles' => [
                'category' => [
                    'name' => 'Sauces Feuilles',
                    'description' => 'Nos délicieuses sauces feuilles traditionnelles'
                ],
                'dishes' => [
                    [
                        'title' => 'Gboman poisson/mouton',
                        'price' => '3000 FCFA',
                        'description' => 'Sauce Gboman traditionnelle avec poisson ou mouton au choix',
                        'preparation_time' => '35 minutes'
                    ],
                    [
                        'title' => 'Gboman agouti',
                        'price' => '6000 FCFA',
                        'description' => 'Sauce Gboman préparée avec de l\'agouti',
                        'preparation_time' => '35 minutes'
                    ],
                    [
                        'title' => 'Sauce égoussi poisson/mouton',
                        'price' => '4500 FCFA',
                        'description' => 'Sauce égoussi traditionnelle avec poisson ou mouton',
                        'preparation_time' => '30 minutes'
                    ]
                ]
            ],
            'riz' => [
                'category' => [
                    'name' => 'Riz',
                    'description' => 'Nos différentes préparations de riz traditionnelles et modernes'
                ],
                'dishes' => [
                    [
                        'title' => 'Riz au poulet + frites',
                        'price' => '4000 FCFA',
                        'description' => 'Riz parfumé servi avec du poulet et accompagné de frites croustillantes',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Riz aux légumes au poulet',
                        'price' => '3500 FCFA',
                        'description' => 'Riz sauté aux légumes frais, servi avec du poulet',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Riz au poisson frité / aloko',
                        'price' => '4000 FCFA',
                        'description' => 'Riz accompagné de poisson frit et de bananes plantains frites (aloko)',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Riz pilaf au poulet',
                        'price' => '4000 FCFA',
                        'description' => 'Riz pilaf parfumé aux épices, servi avec du poulet',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Atassi au poisson',
                        'price' => '3000 FCFA',
                        'description' => 'Mélange traditionnel de riz et de haricots, servi avec du poisson',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Fried rice bœuf',
                        'price' => '3000 FCFA',
                        'description' => 'Riz frit à la façon asiatique, servi avec du bœuf',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Fried rice poulet',
                        'price' => '4000 FCFA',
                        'description' => 'Riz frit à la façon asiatique, servi avec du poulet',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Fried rice crevettes',
                        'price' => '5000 FCFA',
                        'description' => 'Riz frit à la façon asiatique, servi avec des crevettes',
                        'preparation_time' => '20 minutes'
                    ]
                ]
            ],
            'viandes_poissons' => [
                'category' => [
                    'name' => 'Viandes et Poissons',
                    'description' => 'Sélection de viandes et poissons grillés ou braisés, préparés selon nos recettes traditionnelles'
                ],
                'dishes' => [
                    [
                        'title' => 'Poisson braisé (tilapia, bar)',
                        'price' => '5000 FCFA',
                        'description' => 'Poisson frais braisé à la perfection, choix entre tilapia ou bar, servi avec des condiments',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Poisson pané',
                        'price' => '4500 FCFA',
                        'description' => 'Filet de poisson pané croustillant, servi avec une sauce tartare maison',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Poulet braisé entier (bicyclette)',
                        'price' => '4000 FCFA',
                        'description' => 'Poulet local entier braisé aux épices traditionnelles',
                        'preparation_time' => '45 minutes'
                    ],
                    [
                        'title' => '½ Poulet braisé (bicyclette)',
                        'price' => '3000 FCFA',
                        'description' => 'Demi-poulet local braisé aux épices traditionnelles',
                        'preparation_time' => '35 minutes'
                    ],
                    [
                        'title' => 'Poulet braisé (poulet chair)',
                        'price' => '7000 FCFA',
                        'description' => 'Poulet de chair entier braisé, tendre et savoureux',
                        'preparation_time' => '40 minutes'
                    ],
                    [
                        'title' => 'Brochettes de mouton',
                        'price' => '1500 FCFA',
                        'description' => 'Brochettes de mouton tendres et épicées, grillées à la perfection',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Brochettes de gésiers',
                        'price' => '1500 FCFA',
                        'description' => 'Brochettes de gésiers de volaille marinés et grillés',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Saucisse braisée',
                        'price' => '1000 FCFA',
                        'description' => 'Saucisse artisanale braisée sur le grill',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Aileron braisé',
                        'price' => '1500 FCFA',
                        'description' => 'Ailerons de poulet braisés et caramélisés',
                        'preparation_time' => '20 minutes'
                    ]
                ]
            ],
            'desserts' => [
                'category' => [
                    'name' => 'Desserts',
                    'description' => 'Une sélection de fruits frais de saison'
                ],
                'dishes' => [
                    [
                        'title' => 'Ananas frais',
                        'price' => '1000 FCFA',
                        'description' => 'Tranches d\'ananas frais et juteux',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Pommes',
                        'price' => '1000 FCFA',
                        'description' => 'Pommes fraîches servies en quartiers',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Pastèque',
                        'price' => '1000 FCFA',
                        'description' => 'Tranches de pastèque rafraîchissante',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Papaye',
                        'price' => '1000 FCFA',
                        'description' => 'Morceaux de papaye mûre à point',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Raisin',
                        'price' => '1000 FCFA',
                        'description' => 'Grappe de raisin frais',
                        'preparation_time' => '5 minutes'
                    ]
                ]
            ],
            'boissons' => [
                'category' => [
                    'name' => 'Boissons',
                    'description' => 'Large sélection de boissons fraîches et alcoolisées'
                ],
                'dishes' => [
                    [
                        'title' => 'Bières locales (33cl)',
                        'price' => '1000 FCFA',
                        'description' => 'Béninoise, Pils, Beaufort, Eku, chill...',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Bières premium',
                        'price' => '1500 FCFA',
                        'description' => 'Castel, Flag, Guiness, Doppel, Awooyo, Hagbe...',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Sodas (33cl)',
                        'price' => '1000 FCFA',
                        'description' => 'Coca, Sprite, Youki, Malta café, XXL, Tequila',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Sodas (60cl)',
                        'price' => '1500 FCFA',
                        'description' => 'Coca, Sprite, Youki - Format grande bouteille',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Eau minérale (50cl)',
                        'price' => '1000 FCFA',
                        'description' => 'Aquabelle, Fifa, Possotome',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Eau minérale (1.5L)',
                        'price' => '1000 FCFA',
                        'description' => 'Comtesse, Aquabelle, Kwabo, Fifa',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Jus d\'Ananas Nature / en bouteille',
                        'price' => '700 FCFA',
                        'description' => 'Jus d\'ananas frais ou en bouteille',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Jus mixte Ananas + gingembre',
                        'price' => '1000 FCFA',
                        'description' => 'Mélange rafraîchissant d\'ananas et de gingembre',
                        'preparation_time' => '5 minutes'
                    ]
                ]
            ],
            'aperitifs' => [
                'category' => [
                    'name' => 'Apéritifs & Whiskys',
                    'description' => 'Une sélection de spiritueux et liqueurs de qualité'
                ],
                'dishes' => [
                    [
                        'title' => 'Amarula',
                        'price' => '1500 FCFA',
                        'description' => 'Liqueur crémeuse sud-africaine à base de fruit de marula',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Campari',
                        'price' => '1500 FCFA',
                        'description' => 'Apéritif italien aux herbes et agrumes',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Cardhu',
                        'price' => '5000 FCFA',
                        'description' => 'Single malt whisky écossais',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Cointreau',
                        'price' => '5000 FCFA',
                        'description' => 'Liqueur d\'orange française',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Chivas Regal 12 ans',
                        'price' => '5000 FCFA',
                        'description' => 'Scotch whisky blend premium vieilli 12 ans',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Chivas Regal 18 ans',
                        'price' => '10000 FCFA',
                        'description' => 'Scotch whisky blend d\'exception vieilli 18 ans',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Dimple',
                        'price' => '5000 FCFA',
                        'description' => 'Scotch whisky blend raffiné dans sa bouteille distinctive',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Island Green',
                        'price' => '5000 FCFA',
                        'description' => 'Whisky aux notes tourbées des îles écossaises',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Jack Daniel\'s',
                        'price' => '5000 FCFA',
                        'description' => 'Tennessee whiskey américain emblématique',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Label 5',
                        'price' => '5000 FCFA',
                        'description' => 'Scotch whisky blend équilibré et accessible',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Martini',
                        'price' => '1500 FCFA',
                        'description' => 'Vermouth italien, disponible en plusieurs variétés',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Moulin de la Grange',
                        'price' => '1000 FCFA',
                        'description' => 'Vin de table français',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Red Label',
                        'price' => '1500 FCFA',
                        'description' => 'Scotch whisky blend de Johnnie Walker',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Saint James',
                        'price' => '1500 FCFA',
                        'description' => 'Rhum agricole traditionnel de la Martinique',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Suze',
                        'price' => '1500 FCFA',
                        'description' => 'Apéritif français à base de gentiane',
                        'preparation_time' => '2 minutes'
                    ]
                ]
            ],
            'cocktails' => [
                'category' => [
                    'name' => 'Cocktails',
                    'description' => 'Délicieux cocktails préparés par nos barmans'
                ],
                'dishes' => [
                    [
                        'title' => 'Ananas - Pastèque',
                        'price' => '1500 FCFA',
                        'description' => 'Cocktail rafraîchissant à base d\'ananas et de pastèque',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Gingembre - Orange - Mangue',
                        'price' => '1500 FCFA',
                        'description' => 'Mélange exotique de gingembre frais, orange et mangue',
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'title' => 'Pina Colada',
                        'price' => '2000 FCFA',
                        'description' => 'Cocktail classique à base de rhum, ananas et noix de coco',
                        'preparation_time' => '5 minutes'
                    ]
                ]
            ],
            'vins_champagnes' => [
                'category' => [
                    'name' => 'Vins & Champagnes',
                    'description' => 'Une sélection raffinée de vins et champagnes - Prix selon la sélection'
                ],
                'dishes' => [
                    [
                        'title' => 'Vins Blancs',
                        'price' => 'Sur demande',
                        'description' => 'Sélection de vins blancs français et internationaux - Demandez notre carte des vins',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Vins Rouges',
                        'price' => 'Sur demande',
                        'description' => 'Sélection de vins rouges français et internationaux - Demandez notre carte des vins',
                        'preparation_time' => '2 minutes'
                    ],
                    [
                        'title' => 'Champagnes',
                        'price' => 'Sur demande',
                        'description' => 'Sélection de champagnes prestigieux - Demandez notre carte',
                        'preparation_time' => '5 minutes'
                    ]
                ]
            ],
            'autres_resistances' => [
                'category' => [
                    'name' => 'Autres Résistances',
                    'description' => 'Découvrez nos spécialités traditionnelles africaines'
                ],
                'dishes' => [
                    [
                        'title' => 'Amivo au poulet',
                        'price' => '4000 FCFA',
                        'description' => 'Pâte traditionnelle Amivo servie avec une délicieuse sauce au poulet',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Akassa ou éba et monyo au poisson',
                        'price' => '3500 FCFA',
                        'description' => 'Au choix : Akassa (pâte de maïs fermentée) ou éba, servi avec une sauce monyo et du poisson',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Attiéké au poisson bar/tilapia',
                        'price' => '5000 FCFA',
                        'description' => 'Couscous de manioc traditionnel servi avec du poisson bar ou tilapia au choix',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Kpètè au mouton Piron/Akassa',
                        'price' => '3000 FCFA',
                        'description' => 'Kpètè traditionnel servi avec du mouton, accompagné au choix de Piron ou d\'Akassa',
                        'preparation_time' => '30 minutes'
                    ]
                ]
            ],
            'accompagnements' => [
                'category' => [
                    'name' => 'Accompagnements',
                    'description' => 'Une variété d\'accompagnements traditionnels et modernes au choix'
                ],
                'dishes' => [
                    [
                        'title' => 'Pâte de maïs',
                        'price' => 'Inclus',
                        'description' => 'Pâte traditionnelle à base de maïs',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Télibo',
                        'price' => 'Inclus',
                        'description' => 'Accompagnement traditionnel à base de manioc',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Akassa',
                        'price' => 'Inclus',
                        'description' => 'Pâte de maïs fermentée traditionnelle',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Agbléli',
                        'price' => 'Inclus',
                        'description' => 'Manioc bouilli traditionnel',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Igname pilée',
                        'price' => 'Inclus',
                        'description' => 'Purée d\'igname traditionnelle',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Frites d\'igname',
                        'price' => 'Inclus',
                        'description' => 'Igname coupée en bâtonnets et frite',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Pommes de terre sautées',
                        'price' => 'Inclus',
                        'description' => 'Pommes de terre coupées et sautées aux épices',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Piron',
                        'price' => 'Inclus',
                        'description' => 'Pâte traditionnelle africaine',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Couscous',
                        'price' => 'Inclus',
                        'description' => 'Semoule de blé cuite à la vapeur',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Riz',
                        'price' => 'Inclus',
                        'description' => 'Riz blanc parfumé',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Frites',
                        'price' => 'Inclus',
                        'description' => 'Pommes de terre frites croustillantes',
                        'preparation_time' => '10 minutes'
                    ],
                    [
                        'title' => 'Alloco',
                        'price' => 'Inclus',
                        'description' => 'Bananes plantains frites',
                        'preparation_time' => '10 minutes'
                    ]
                ]
            ],
            'salades' => [
                'category' => [
                    'name' => 'Salades',
                    'description' => 'Nos salades fraîches et gourmandes préparées avec des produits de saison'
                ],
                'dishes' => [
                    [
                        'title' => 'Salade composée',
                        'price' => '2500 FCFA',
                        'description' => 'Mélange de légumes frais, œufs et autres ingrédients de saison',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Salade mixte',
                        'price' => '3000 FCFA',
                        'description' => 'Assortiment varié de légumes, fromages et charcuteries',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Salade au poulet',
                        'price' => '3000 FCFA',
                        'description' => 'Salade fraîche garnie de morceaux de poulet grillé',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Salade floridale',
                        'price' => '3500 FCFA',
                        'description' => 'Salade exotique avec fruits et légumes de saison',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Salade belle saison',
                        'price' => '2500 FCFA',
                        'description' => 'Salade légère aux légumes de saison',
                        'preparation_time' => '15 minutes'
                    ]
                ]
            ],
            'fast_food' => [
                'category' => [
                    'name' => 'Fast Food',
                    'description' => 'Une sélection de plats rapides et savoureux, préparés à la commande'
                ],
                'dishes' => [
                    [
                        'title' => 'Chawama poulet',
                        'price' => '2000 FCFA',
                        'description' => 'Sandwich de poulet grillé aux épices orientales, légumes frais et sauces maison',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Chawama viande',
                        'price' => '1500 FCFA',
                        'description' => 'Sandwich de viande grillée aux épices orientales, légumes frais et sauces maison',
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'title' => 'Pizza Royal - Petite',
                        'price' => '4000 FCFA',
                        'description' => 'Pizza garnie de jambon, champignons, poivrons et fromage - Format individuel',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Pizza Royal - Grande',
                        'price' => '7000 FCFA',
                        'description' => 'Pizza garnie de jambon, champignons, poivrons et fromage - Format familial',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Pizza Margherita - Petite',
                        'price' => '3000 FCFA',
                        'description' => 'Pizza classique avec sauce tomate, mozzarella et basilic - Format individuel',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Pizza Margherita - Grande',
                        'price' => '6000 FCFA',
                        'description' => 'Pizza classique avec sauce tomate, mozzarella et basilic - Format familial',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Pizza Reine - Petite',
                        'price' => '4000 FCFA',
                        'description' => 'Pizza avec jambon, champignons, olives et fromage - Format individuel',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Pizza Reine - Grande',
                        'price' => '8000 FCFA',
                        'description' => 'Pizza avec jambon, champignons, olives et fromage - Format familial',
                        'preparation_time' => '25 minutes'
                    ]
                ]
            ],
            'steaks' => [
                'category' => [
                    'name' => 'Les Steaks et Pâtes',
                    'description' => 'Nos spécialités de viandes et pâtes préparées avec soin'
                ],
                'dishes' => [
                    [
                        'title' => 'Steak au poivre',
                        'price' => '2000 FCFA',
                        'description' => 'Steak de bœuf grillé avec sa sauce au poivre noir concassé',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Émincé de filet aux champignons',
                        'price' => '8000 FCFA',
                        'description' => 'Fines tranches de filet de bœuf sautées avec champignons frais',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Émincé de Filet de bœuf à la crème',
                        'price' => '5000 FCFA',
                        'description' => 'Émincé de bœuf dans une sauce crémeuse délicatement parfumée',
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'title' => 'Sauce forestière',
                        'price' => '5000 FCFA',
                        'description' => 'Sauce aux champignons des bois et crème fraîche',
                        'preparation_time' => '25 minutes'
                    ],
                    [
                        'title' => 'Spaghettis bolognaise',
                        'price' => '4000 FCFA',
                        'description' => 'Pâtes fraîches servies avec une sauce à la viande mijotée',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Spaghettis rouge et blanc à l\'omelette',
                        'price' => '3500 FCFA',
                        'description' => 'Spaghettis servis avec sauce tomate, sauce crème et omelette',
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'title' => 'Spaghettis rouge et blanc au poulet',
                        'price' => '4000 FCFA',
                        'description' => 'Spaghettis servis avec sauce tomate, sauce crème et poulet grillé',
                        'preparation_time' => '25 minutes'
                    ]
                ]
            ]
        ];

        return $categories[$slug] ?? null;
    }

    public function render()
    {
        return view('livewire.home.dashe-details-page')->extends('layouts.home')->section('content');
    }
}
