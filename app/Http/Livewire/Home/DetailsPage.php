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
                    'description' => 'L\'excellence de la cuisine togolaise à travers nos différentes préparations d\'igname pilée'
                ],
                'dishes' => [
                    [
                        'id' => 1,
                        'title' => 'Igname pilée sauce claire',
                        'description' => 'Délicieuse igname pilée servie avec une sauce claire légère et parfumée, accompagnée de morceaux de poulet tendres et juteux.',
                        'price' => '3000 FCFA',
                        'images' => [
                            asset('home/details/d1/1.jpeg'),
                            asset('home/details/d1/6.jpeg'),
                            asset('home/details/d1/3.jpeg'),
                            asset('home/details/d1/4.jpeg'),
                            asset('home/details/d1/5.jpeg'),
                            asset('home/details/d1/7.jpeg'),
                        ],
                        'ingredients' => ['Igname fraîche', 'Poulet fermier', 'Tomates', 'Oignons', 'Épices traditionnelles', 'Légumes verts'],
                        'preparation_time' => '35 minutes'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Pate de maïs',
                        'description' => "Savoureuse pâte de maïs accompagnée d'une sauce arachide onctueuse et riche, garnie de morceaux de viande de bœuf succulents, pour une expérience culinaire authentique.",
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
                        'description' => "Délectable pâte d'igname servie avec une sauce arachide crémeuse et savoureuse, sublimée par des morceaux de viande de bœuf tendres et assaisonnés d'épices locales.",
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
                    'name' => 'Le Riz',
                    'description' => 'Une sélection de steaks savoureux préparés selon vos préférences'
                ],
                'dishes' => [
                    [
                        'id' => 3,
                        'title' => 'Le riz blanc & Le Atassi',
                        'description' => "Riz blanc parfaitement cuit, accompagné de poissons braisé à la perfection, assaisonné d'épices savoureuses.",
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
                            asset('home/details/d4/2.jpeg'),
                            asset('home/details/d4/10.jpeg')
                        ],
                        'ingredients' => ['Bœuf de qualité supérieure', 'Épices', 'Beurre maître d\'hôtel'],
                        'preparation_time' => '20 minutes'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Le poisson braisé',
                        'description' => "De délicieux poisson braisé, cuit à perfection dans une sauce savoureuse, accompagné de pomme de terre frite pour un repas complet et satisfaisant.",
                        // 'description' => "Délicieux Atassi, un mélange traditionnel de riz et de haricots, rehaussé de savoureux poisson ou viande, servi avec une sauce crémeuse.",
                        'price' => '5000 FCFA',
                        'images' => [
                            asset('home/details/d0/1.jpeg'),
                            asset('home/details/d0/2.jpeg'),
                            asset('home/details/d0/3.png'),
                            asset('home/details/d0/4.jpeg'),
                            asset('home/details/d0/5.jpeg'),
                            asset('home/details/d0/6.jpeg'),
                            asset('home/details/d0/7.jpeg')
                        ],
                        'ingredients' => ['Bœuf tendre', 'Poivre noir', 'Crème fraîche', 'Cognac'],
                        'preparation_time' => '25 minutes'
                    ], 
                    [
                        'id' => 5,
                        'title' => 'Le riz creol - Riz au gras',
                        'description' => "Riz créole riche et parfumé, cuit dans une sauce grasse et accompagnée de morceaux de viande tendre, relevée par des épices et une touche de poivre noir, pour une explosion de saveurs exotiques.",
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
                        'title' => 'Sauce Gluante',
                        'description' => "Savoureuse sauce gombo, sublimée par des épices locales pour une expérience authentique et réconfortante.",
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
                        'title' => 'Sauce tomate',
                        'description' => "Délicieuse sauce tomate légère, mijotée avec de la viande.",
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
                    // [
                    //     'id' => 8,
                    //     'title' => 'Autre Sauce',
                    //     'description' => 'Une sauce légère et savoureuse à base de poisson fumé',
                    //     'price' => '1200 FCFA',
                    //     'images' => [
                    //         asset('home/details/d3/10.jpeg'),
                    //         asset('home/details/d3/6.jpeg'),
                    //     ],
                    //     'ingredients' => ['Poisson fumé', 'Légumes verts', 'Épices locales'],
                    //     'preparation_time' => '30 minutes'
                    // ]
                ]
            ],
            'fast_food' => [
                'category' => [
                    'name' => 'Fast Food',
                    'description' => 'Une sélection de plats rapides et délicieux'
                ],
                'dishes' => [
                    [
                        'id' => 8,
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
                        'id' => 9,
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
                        'id' => 10,
                        'title' => 'Pommes Frites',
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
                        'id' => 11,
                        'title' => 'Jus',
                        'description' => "Cocktail rafraîchissant à base de menthe fraîche, citron et autres fruits exotiques frais tels que la mangue, l'ananas et le fruit de la passion, enrichies de lait de coco pour une touche de douceur tropicale",
                        'price' => '2000 FCFA',
                        'images' => [
                            asset('home/details/d5/15.jpeg'),
                            asset('home/details/d5/13.jpeg'),
                            asset('home/details/d5/14.jpeg'),
                            asset('home/details/d5/10.jpeg'),
                            asset('home/details/d5/9.jpeg')
                        ],
                        'ingredients' => ['Rhum', 'Menthe fraîche', 'Citron vert', 'Sucre de canne'],
                        'preparation_time' => '5 minutes'
                    ],
                    [
                        'id' => 12,
                        'title' => 'Glaces',
                        'description' => "Un assortiment gourmand de glaces aux saveurs variées, incluant vanille, chocolat, fraise et autres délices, parfait pour se rafraîchir et satisfaire toutes les envies sucrées.",
                        'price' => '1800 FCFA',
                        'images' => [
                            asset('home/details/d5/1.jpeg'),
                            asset('home/details/d5/2.jpeg'),
                            asset('home/details/d5/4.jpeg'),
                            asset('home/details/d5/5.jpeg'),
                            asset('home/details/d5/6.jpeg'),
                            asset('home/details/d5/8.jpeg'),
                            asset('home/details/d5/7.jpeg'),
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Fruit de la passion', 'Lait de coco'],
                        'preparation_time' => '10 minutes'
                    ],
                    // [
                    //     'id' => 14,
                    //     'title' => 'Smoothie Tropical',
                    //     'description' => 'Mélange de fruits exotiques frais',
                    //     'price' => '1800 FCFA',
                    //     'images' => [
                    //         asset('home/details/d5/7.jpeg'),
                    //         asset('home/details/d5/9.jpeg')
                    //     ],
                    //     'ingredients' => ['Mangue', 'Ananas', 'Fruit de la passion', 'Lait de coco'],
                    //     'preparation_time' => '10 minutes'
                    // ]
                ]
            ],
            'autres' => [
                'category' => [
                    'name' => 'autres',
                    'description' => 'Une sélection de desserts gourmands pour terminer en douceur'
                ],
                'dishes' => [
                    [
                        'id' => 14,
                        'title' => 'Amiwo, Piron',
                        'description' => 'Délicieux Amiwo, une spécialité béninoise de pâte de maïs rouge, de Piron, une pâte douce à base de manioc, le tout servi avec une sauce savoureuse pour une expérience culinaire authentique.',
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
                        'id' => 15,
                        'title' => 'Atchèkè',
                        'description' => "Plat traditionnel ivoirien, servi avec du poisson grillé ou du poulet, accompagné d'une sauce épicée et d'oignons sautés pour un repas complet et délicieux.",
                        'price' => '1200 FCFA',
                        'images' => [
                            asset('home/details/d6/3.png'),
                            asset('home/details/d6/6.jpeg'),
                            // asset('home/details/d6/5.jpeg'),
                            // asset('home/details/d6/8.jpeg'),
                        ],
                        'ingredients' => ['Mangue', 'Ananas', 'Papaye', 'Fruit du dragon'],
                        'preparation_time' => '15 minutes'
                    ], 
                    [
                        'id' => 16,
                        'title' => 'Autre repas',
                        'description' => "Une sélection variée de plats traditionnels, combinant des saveurs locales authentiques et des ingrédients frais, pour un repas riche en goût et en culture.",
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
