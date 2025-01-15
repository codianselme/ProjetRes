<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class DetailsPage extends Component
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
            'igname_pilee_sauce_claire_togo' => [
                'category' => [
                    'name' => 'Igname Pilée & Sauces',
                    'description' => 'Découvrez notre sélection d\'igname pilée accompagnée de différentes sauces traditionnelles'
                ],
                'dishes' => [
                    [
                        'id' => 1,
                        'title' => 'Igname Pilée',
                        'description' => 'L\'igname pilée traditionnelle servie avec une sauce claire légère et savoureuse',
                        'price' => '3000 FCFA',
                        'images' => [
                            asset('home/details/d1/1.jpeg'),
                            asset('home/details/d1/6.jpeg'),
                            asset('home/details/d1/3.jpeg'),
                            asset('home/details/d1/4.jpeg'),
                            asset('home/details/d1/5.jpeg'),
                            asset('home/details/d1/7.jpeg'),
                        ],
                        'ingredients' => ['Igname', 'Poisson fumé', 'Épinards', 'Épices traditionnelles'],
                        'preparation_time' => '30 minutes'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Pate de Mais',
                        'description' => 'Notre délicieuse igname pilée servie avec une sauce arachide crémeuse',
                        'price' => '3500 FCFA',
                        'images' => [
                            asset('home/details/d1/9.jpeg'),
                            asset('home/details/d1/15.jpeg'),
                            asset('home/details/d1/16.jpeg')
                        ],
                        'ingredients' => ['Igname', 'Pâte d\'arachide', 'Viande de bœuf', 'Épices locales'],
                        'preparation_time' => '35 minutes'
                    ],
                    [
                        'id' => 3,
                        'title' => "Pate de caussette d'igname",
                        'description' => 'Notre délicieuse igname pilée servie avec une sauce arachide crémeuse',
                        'price' => '3500 FCFA',
                        'images' => [
                            asset('home/details/d1/12.jpeg'),
                            asset('home/details/d1/17.jpeg')
                        ],
                        'ingredients' => ['Igname', 'Pâte d\'arachide', 'Viande de bœuf', 'Épices locales'],
                        'preparation_time' => '35 minutes'
                    ],
                ]
            ],
            'le_riz' => [
                'category' => [
                    'name' => 'Les Steaks',
                    'description' => 'Une sélection de steaks savoureux préparés selon vos préférences'
                ],
                'dishes' => [
                    [
                        'id' => 3,
                        'title' => 'Le riz blanc',
                        'description' => 'Un steak de bœuf juteux grillé à la perfection',
                        'price' => '4500 FCFA',
                        'images' => [
                            asset('home/details/d4/4.png'),
                            asset('home/details/d4/9.jpeg'),
                            asset('home/details/d4/13.jpeg'),
                            asset('home/details/d4/14.jpeg'),
                            asset('home/details/d4/22.webp'),
                            asset('home/details/d4/28.png'),
                            asset('home/details/d4/29.jpeg'),
                            asset('home/details/d4/30.jpeg'),
                            asset('home/details/d4/32.jpeg'), 
                            asset('home/details/d4/35.jpeg'), 
                        ],
                        'ingredients' => ['Bœuf de qualité supérieure', 'Épices', 'Beurre maître d\'hôtel'],
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Le Atassi',
                        'description' => 'Steak enrobé de poivre concassé avec sa sauce crémeuse',
                        'price' => '5000 FCFA',
                        'images' => [
                            asset('home/details/d4/2.jpeg'),
                            asset('home/details/d4/10.jpeg')
                        ],
                        'ingredients' => ['Bœuf tendre', 'Poivre noir', 'Crème fraîche', 'Cognac'],
                        'preparation_time' => '25 minutes'
                    ], 
                    [
                        'id' => 5,
                        'title' => 'Le riz creol',
                        'description' => 'Steak enrobé de poivre concassé avec sa sauce crémeuse',
                        'price' => '5000 FCFA',
                        'images' => [
                            asset('home/details/d4/5.jpeg'),
                            asset('home/details/d4/6.jpeg'),
                            asset('home/details/d4/8.jpeg'),
                            asset('home/details/d4/11.jpeg'),
                            asset('home/details/d4/19.jpeg'),
                            asset('home/details/d4/21.webp'),
                            asset('home/details/d4/23.jpg'),
                            asset('home/details/d4/25.jpeg'),
                            asset('home/details/d4/29.jpeg'),
                            asset('home/details/d4/30.jpeg'),
                            asset('home/details/d4/31.jpeg'), 
                            asset('home/details/d4/34.jpeg'), 
                        ],
                        'ingredients' => ['Bœuf tendre', 'Poivre noir', 'Crème fraîche', 'Cognac'],
                        'preparation_time' => '25 minutes'
                    ]
                ]
            ],
            'nos_sauces' => [
                'category' => [
                    'name' => 'Nos Sauces',
                    'description' => 'Des sauces traditionnelles et modernes pour accompagner vos plats'
                ],
                'dishes' => [
                    [
                        'id' => 6,
                        'title' => 'Sauce Arachide',
                        'description' => 'Une sauce crémeuse à base d\'arachides fraîchement moulues',
                        'price' => '1500 FCFA',
                        'images' => [
                            asset('home/details/d3/3.jpeg'),
                            asset('home/details/d3/5.jpeg'),
                            asset('home/details/d3/7.jpeg'),
                            asset('home/details/d3/9.jpeg'),
                            asset('home/details/d3/14.jpeg'),
                        ],
                        'ingredients' => ['Pâte d\'arachide', 'Tomates', 'Oignons', 'Épices'],
                        'preparation_time' => '45 minutes'
                    ],
                    [
                        'id' => 7,
                        'title' => 'Sauce Claire',
                        'description' => 'Une sauce légère et savoureuse à base de poisson fumé',
                        'price' => '1200 FCFA',
                        'images' => [
                            asset('home/details/d3/1.jpeg'),
                            asset('home/details/d3/2.jpeg'),
                            asset('home/details/d3/8.jpeg'),
                            // asset('home/details/d3/6.jpeg'),
                            asset('home/details/d3/12.jpeg')
                        ],
                        'ingredients' => ['Poisson fumé', 'Légumes verts', 'Épices locales'],
                        'preparation_time' => '30 minutes'
                    ], 
                    [
                        'id' => 8,
                        'title' => 'Sauce Claire',
                        'description' => 'Une sauce légère et savoureuse à base de poisson fumé',
                        'price' => '1200 FCFA',
                        'images' => [
                            asset('home/details/d3/10.jpeg'),
                            asset('home/details/d3/6.jpeg'),
                        ],
                        'ingredients' => ['Poisson fumé', 'Légumes verts', 'Épices locales'],
                        'preparation_time' => '30 minutes'
                    ]
                ]
            ],
            'fast_food' => [
                'category' => [
                    'name' => 'Fast Food',
                    'description' => 'Une sélection de plats rapides et délicieux'
                ],
                'dishes' => [
                    [
                        'id' => 9,
                        'title' => 'Chawarma',
                        'description' => 'Notre burger signature avec sauce maison',
                        'price' => '2500 FCFA',
                        'images' => [
                            asset('home/details/d7/7.jpeg'),
                            asset('home/details/d7/5.jpeg'),
                        ],
                        'ingredients' => ['Pain artisanal', 'Bœuf haché', 'Fromage', 'Légumes frais'],
                        'preparation_time' => '15 minutes'
                    ],
                    [
                        'id' => 10,
                        'title' => 'Pizza, Burger',
                        'description' => 'Frites croustillantes préparées sur place',
                        'price' => '1000 FCFA',
                        'images' => [
                            asset('home/details/d7/2.jpeg'),
                            asset('home/details/d7/8.jpeg'),
                            asset('home/details/d7/3.jpeg'),
                            
                        ],
                        'ingredients' => ['Pommes de terre fraîches', 'Huile végétale', 'Sel'],
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'id' => 11,
                        'title' => 'Frites Maison',
                        'description' => 'Frites croustillantes préparées sur place',
                        'price' => '1000 FCFA',
                        'images' => [
                            asset('home/details/d7/1.jpeg'),
                            asset('home/details/d7/4.jpeg'),
                            asset('home/details/d7/6.jpeg'),
                        ],
                        'ingredients' => ['Pommes de terre fraîches', 'Huile végétale', 'Sel'],
                        'preparation_time' => '20 minutes'
                    ]
                ]
            ],
            'coocktail' => [
                'category' => [
                    'name' => 'Cocktails',
                    'description' => 'Des cocktails rafraîchissants avec ou sans alcool'
                ],
                'dishes' => [
                    [
                        'id' => 12,
                        'title' => 'Mojito',
                        'description' => 'Cocktail rafraîchissant à base de menthe fraîche',
                        'price' => '2000 FCFA',
                        'images' => [
                            asset('home/details/d5/15.jpeg'),
                            asset('home/details/d5/13.jpeg'),
                            asset('home/details/d5/14.jpeg'),
                            asset('home/details/d5/10.jpeg'),
                        ],
                        'ingredients' => ['Rhum', 'Menthe fraîche', 'Citron vert', 'Sucre de canne'],
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'id' => 13,
                        'title' => 'Smoothie Tropical',
                        'description' => 'Mélange de fruits exotiques frais',
                        'price' => '1800 FCFA',
                        'images' => [
                            asset('home/details/d5/1.jpeg'),
                            asset('home/details/d5/2.jpeg'),
                            asset('home/details/d5/4.jpeg'),
                            asset('home/details/d5/5.jpeg'),
                            asset('home/details/d5/6.jpeg'),
                            asset('home/details/d5/8.jpeg'),
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Fruit de la passion', 'Lait de coco'],
                        'preparation_time' => '10 minutes'
                    ],
                    [
                        'id' => 14,
                        'title' => 'Smoothie Tropical',
                        'description' => 'Mélange de fruits exotiques frais',
                        'price' => '1800 FCFA',
                        'images' => [
                            asset('home/details/d5/7.jpeg'),
                            asset('home/details/d5/9.jpeg')
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Fruit de la passion', 'Lait de coco'],
                        'preparation_time' => '10 minutes'
                    ]
                ]
            ],
            'autres' => [
                'category' => [
                    'name' => 'autres',
                    'description' => 'Une sélection de desserts gourmands pour terminer en douceur'
                ],
                'dishes' => [
                    [
                        'id' => 15,
                        'title' => 'Gâteau au Chocolat',
                        'description' => 'Gâteau moelleux au chocolat noir',
                        'price' => '1500 FCFA',
                        'images' => [
                            asset('home/details/d6/17.jpeg'),
                            asset('home/details/d6/2.jpeg'),
                            asset('home/details/d6/18.jpeg'),
                            asset('home/details/d6/20.jpeg'),
                            asset('home/details/d6/14.jpeg'),
                        ],
                        'ingredients' => ['Chocolat noir', 'Œufs', 'Farine', 'Beurre'],
                        'preparation_time' => '40 minutes'
                    ],
                    [
                        'id' => 16,
                        'title' => 'Salade de Fruits Frais',
                        'description' => 'Assortiment de fruits frais de saison',
                        'price' => '1200 FCFA',
                        'images' => [
                            asset('home/details/d6/3.png'),
                            asset('home/details/d6/6.jpeg'),
                            asset('home/details/d6/5.jpeg'),
                            asset('home/details/d6/8.jpeg'),
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Papaye', 'Fruit du dragon'],
                        'preparation_time' => '15 minutes'
                    ], 
                    [
                        'id' => 17,
                        'title' => 'Salade de Fruits Frais',
                        'description' => 'Assortiment de fruits frais de saison',
                        'price' => '1200 FCFA',
                        'images' => [
                            asset('home/details/d6/5.jpeg'),
                            asset('home/details/d6/8.jpeg'),
                            asset('home/details/d6/9.jpeg'),
                            asset('home/details/d6/10.jpeg'),
                            asset('home/details/d6/11.jpeg'),
                            asset('home/details/d6/12.jpg'),
                            asset('home/details/d6/13.jpeg'),
                            asset('home/details/d6/15.jpeg'),
                            asset('home/details/d6/16.jpeg'),
                            asset('home/details/d6/19.jpeg'),
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Papaye', 'Fruit du dragon'],
                        'preparation_time' => '15 minutes'
                    ]
                ]
            ]
        ];

        return $categories[$slug] ?? null;
    }

    public function orderDish($dishId)
    {
        // Logique pour commander un plat
        session()->flash('message', 'Plat ajouté au panier avec succès!');
    }

    public function render()
    {
        return view('livewire.home.details-page')->extends('layouts.home')->section('content');
    }
}