<?php

namespace App\Http\Livewire\Home;

use App\Models\User;
use App\Models\Command;
use Livewire\Component;
use App\Mail\CommandMail;
use App\Models\CommandItem;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class DasheDetailsPage extends Component
{
    public $slug;
    public $category;
    public $dishes;
    public $details;
    public $cart = [];
    public $showCommandForm = false;
    public $commandForm = [
        'customer_name' => '',
        'phone' => '',
        'email' => '',
        'delivery_address' => '',
        'notes' => ''
    ];
    public $showCart = false;

    protected $rules = [
        'commandForm.customer_name' => 'required|min:3',
        'commandForm.phone' => 'required|regex:/^[0-9]{8,}$/',
        'commandForm.email' => 'nullable|email',
        'commandForm.delivery_address' => 'required|min:10',
    ];

    protected $messages = [
        'commandForm.customer_name.required' => 'Le nom est obligatoire',
        'commandForm.customer_name.min' => 'Le nom doit contenir au moins 3 caractères',
        
        'commandForm.phone.required' => 'Le numéro de téléphone est obligatoire',
        'commandForm.phone.regex' => 'Le numéro de téléphone doit contenir au moins 8 chiffres',
        
        'commandForm.email.email' => 'Veuillez entrer une adresse email valide',
        
        'commandForm.delivery_address.required' => 'L\'adresse de livraison est obligatoire',
        'commandForm.delivery_address.min' => 'L\'adresse doit contenir au moins 10 caractères',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $categoryData = $this->getCategoryDetails($slug);
        
        if (!$categoryData) {
            return redirect()->route('home.page');
        }

        $this->category = $categoryData['category'];
        $this->dishes = $categoryData['dishes'];
        $this->details = $categoryData['details'] ?? null;
    }

    private function getCategoryDetails($slug)
    {
        $categories = [
            'igname_pilee' => [
                'category' => [
                    'name' => 'Igname Pilée',
                    'description' => 'Découvrez nos délicieuses préparations d\'igname pilée accompagnées de sauces variées'
                ],
                'details' => [
                    [
                        'image' => 'home/details/a0_igname_pilee/1.jpeg',
                        'title' => 'Préparation traditionnelle',
                        'description' => 'Notre igname pilée est préparée selon la tradition'
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/2.jpeg',
                        'title' => 'Sauces variées',
                        'description' => 'Accompagnée de sauces authentiques'
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/3.jpeg',
                        'title' => 'Service soigné',
                        'description' => 'Une présentation élégante et appétissante'
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/4.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/5.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/6.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/7.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/8.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/9.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/10.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a0_igname_pilee/11.jpeg',
                        'title' => 'Service soigné',
                        'description' => ''
                    ],
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
                        'title' => 'Igname pilée sauce graines poisson Fumé',
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
                'details' => [
                    [
                        'image' => 'home/details/a1_sauces_feuilles/1.jpeg',
                        'title' => 'Sauce Gboma',
                        'description' => 'Sauce traditionnelle à base de feuilles de gboma'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/2.jpeg',
                        'title' => 'Préparation Soignée',
                        'description' => 'Nos sauces sont préparées avec des ingrédients frais'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/3.jpeg',
                        'title' => 'Sauce Crincrin',
                        'description' => 'Délicieuse sauce à base de feuilles de crincrin'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/4.jpeg',
                        'title' => 'Accompagnements',
                        'description' => 'Servie avec viande ou poisson au choix'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/5.jpeg',
                        'title' => 'Présentation',
                        'description' => 'Une présentation soignée et appétissante'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/6.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => 'Sauce traditionnelle aux feuilles d\'adémè'
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/6.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/7.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/8.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/9.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    // [
                    //     'image' => 'home/details/a1_sauces_feuilles/10.jpeg',
                    //     'title' => 'Sauce Adémè',
                    //     'description' => ''
                    // ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/11.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    // [
                    //     'image' => 'home/details/a1_sauces_feuilles/12.jpeg',
                    //     'title' => 'Sauce Adémè',
                    //     'description' => ''
                    // ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/13.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/14.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a1_sauces_feuilles/15.jpeg',
                        'title' => 'Sauce Adémè',
                        'description' => ''
                    ],
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
                'details' => [
                    [
                        'image' => 'home/details/a2_riz/1.jpeg',
                        'title' => 'Riz au poulet',
                        'description' => 'Riz parfumé servi avec du poulet grillé'
                    ],
                    [
                        'image' => 'home/details/a2_riz/2.jpeg',
                        'title' => 'Riz aux légumes',
                        'description' => 'Riz sauté avec des légumes frais de saison'
                    ],
                    [
                        'image' => 'home/details/a2_riz/3.jpeg',
                        'title' => 'Riz au poisson',
                        'description' => 'Riz accompagné de poisson frais'
                    ],
                    [
                        'image' => 'home/details/a2_riz/4.png',
                        'title' => 'Riz pilaf',
                        'description' => 'Riz pilaf aux épices et aromates'
                    ],
                    [
                        'image' => 'home/details/a2_riz/5.jpeg',
                        'title' => 'Atassi traditionnel',
                        'description' => 'Mélange de riz et haricots à la sauce tomate'
                    ],
                    [
                        'image' => 'home/details/a2_riz/6.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => 'Riz frit à la façon asiatique avec légumes et protéines'
                    ],
                    // [
                    //     'image' => 'home/details/a2_riz/7.jpeg',
                    //     'title' => 'Fried rice spécial',
                    //     'description' => ''
                    // ],
                    [
                        'image' => 'home/details/a2_riz/8.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/9.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/10.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/11.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/12.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/13.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/14.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    // [
                    //     'image' => 'home/details/a2_riz/15.jpeg',
                    //     'title' => 'Fried rice spécial',
                    //     'description' => ''
                    // ],
                    [
                        'image' => 'home/details/a2_riz/16.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/17.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/18.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/19.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/20.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/21.webp',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/23.jpg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/25.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/26.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/28.png',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/29.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/30.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/31.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/32.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/33.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/34.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a2_riz/35.jpeg',
                        'title' => 'Fried rice spécial',
                        'description' => ''
                    ],
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
                        'title' => 'Riz au poisson frite / aloko',
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
                'details' => [
                [
                    'image' => 'home/details/a4_viandes_poissons/1.jpeg',
                    'title' => 'Poisson braisé',
                    'description' => 'Poisson frais braisé aux épices traditionnelles'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/2.jpeg',
                    'title' => 'Poulet braisé',
                    'description' => 'Poulet local braisé à la perfection'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/3.png',
                    'title' => 'Brochettes de mouton',
                    'description' => 'Tendres brochettes de mouton grillées'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/4.jpeg',
                    'title' => 'Poisson pané',
                    'description' => 'Filet de poisson pané croustillant'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/5.jpeg',
                    'title' => 'Gésiers braisés',
                    'description' => 'Gésiers de volaille marinés et braisés'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/6.jpeg',
                    'title' => 'Saucisses braisées',
                    'description' => 'Saucisses artisanales grillées'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/7.jpeg',
                    'title' => 'Saucisses braisées',
                    'description' => 'Saucisses artisanales grillées'
                ],
                [
                    'image' => 'home/details/a4_viandes_poissons/12.jpg',
                    'title' => 'Saucisses braisées',
                    'description' => 'Saucisses artisanales grillées'
                ],
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
                'details' => [
                [
                    'image' => 'home/details/a9_desserts/1.jpeg',
                    'title' => 'Ananas frais',
                    'description' => 'Tranches d\'ananas juteux et parfumé'
                ],
                [
                    'image' => 'home/details/a9_desserts/2.jpeg',
                    'title' => 'Pastèque',
                    'description' => 'Tranches de pastèque rafraîchissante'
                ],
                [
                    'image' => 'home/details/a9_desserts/3.jpeg',
                    'title' => 'Papaye',
                    'description' => 'Morceaux de papaye mûre à point'
                ],
                [
                    'image' => 'home/details/a9_desserts/4.jpeg',
                    'title' => 'Pommes',
                    'description' => 'Pommes fraîches servies en quartiers'
                ],
                // [
                //     'image' => 'home/details/a9_desserts/5.jpeg',
                //     'title' => 'Raisin',
                //     'description' => 'Grappe de raisin frais et sucré'
                // ],
                // [
                //     'image' => 'home/details/a9_desserts/6.jpeg',
                //     'title' => 'Assortiment de fruits',
                //     'description' => 'Sélection variée de fruits frais de saison'
                // ]
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
                'details' => [
                [
                    'image' => 'home/details/a10_boissons/3.jpg',
                    'title' => 'Bières Locales',
                    'description' => 'Sélection de bières locales rafraîchissantes'
                ],
                [
                    'image' => 'home/details/a10_boissons/4.jpg',
                    'title' => 'Bières Premium',
                    'description' => 'Collection de bières premium internationales'
                ],
                [
                    'image' => 'home/details/a10_boissons/5.jpg',
                    'title' => 'Sodas',
                    'description' => 'Variété de sodas rafraîchissants'
                ],
                [
                    'image' => 'home/details/a10_boissons/6.png',
                    'title' => 'Eau Minérale',
                    'description' => 'Eau minérale pure et rafraîchissante'
                ],
                [
                    'image' => 'home/details/a10_boissons/8.jpg',
                    'title' => 'Jus Naturels',
                    'description' => 'Jus de fruits frais pressés'
                ],
                [
                    'image' => 'home/details/a10_boissons/9.jpg',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/10.jpg',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/12.jpg',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/14.png',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/15.jpg',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/16.jpg',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
                [
                    'image' => 'home/details/a10_boissons/18.png',
                    'title' => 'Cocktails',
                    'description' => 'Cocktails signature préparés avec soin'
                ],
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
                'details' => [
                [
                    'image' => 'home/details/a11_aperitifs/1.jpeg',
                    'title' => 'Whiskys Premium',
                    'description' => 'Sélection de whiskys haut de gamme'
                ],
                [
                    'image' => 'home/details/a11_aperitifs/2.jpeg',
                    'title' => 'Liqueurs Fines',
                    'description' => 'Collection de liqueurs raffinées'
                ],
                [
                    'image' => 'home/details/a11_aperitifs/3.jpeg',
                    'title' => 'Apéritifs Classiques',
                    'description' => 'Assortiment d\'apéritifs traditionnels'
                ],
                [
                    'image' => 'home/details/a11_aperitifs/4.jpeg',
                    'title' => 'Spiritueux Sélects',
                    'description' => 'Gamme de spiritueux de qualité'
                ],
                [
                    'image' => 'home/details/a11_aperitifs/5.jpeg',
                    'title' => 'Digestifs',
                    'description' => 'Choix de digestifs raffinés'
                ],
                [
                    'image' => 'home/details/a11_aperitifs/6.jpeg',
                    'title' => 'Service Premium',
                    'description' => 'Service personnalisé et professionnel'
                ]
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
                        'description' => 'Apéritif français à base de gentiane', // 3709 
                        'preparation_time' => '2 minutes'
                    ]
                ]
            ],
            'cocktails' => [
                'category' => [
                    'name' => 'Cocktails',
                    'description' => 'Délicieux cocktails préparés par nos barmans'
                ],
                'details' => [
                [
                    'image' => 'home/details/a12_cocktails/1.jpeg',
                    'title' => 'Cocktails Classiques',
                    'description' => 'Sélection de cocktails traditionnels'
                ],
                [
                    'image' => 'home/details/a12_cocktails/2.jpeg',
                    'title' => 'Cocktails Signature',
                    'description' => 'Nos créations exclusives'
                ],
                [
                    'image' => 'home/details/a12_cocktails/3.jpeg',
                    'title' => 'Mocktails',
                    'description' => 'Cocktails sans alcool'
                ],
                [
                    'image' => 'home/details/a12_cocktails/4.jpeg',
                    'title' => 'Cocktails Fruités',
                    'description' => 'Mélanges de fruits frais'
                ],
                [
                    'image' => 'home/details/a12_cocktails/5.jpeg',
                    'title' => 'Cocktails Premium',
                    'description' => 'Créations haut de gamme'
                ],
                [
                    'image' => 'home/details/a12_cocktails/6.jpeg',
                    'title' => 'Service Cocktail',
                    'description' => 'Préparation professionnelle'
                ]
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
                'details' => [
                    [
                        'image' => 'home/details/a13_vins_champagnes/1.jpeg',
                        'title' => 'Vins Rouges',
                        'description' => 'Sélection de grands vins rouges'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/2.jpeg',
                        'title' => 'Vins Blancs',
                        'description' => 'Collection de vins blancs raffinés'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/3.jpeg',
                        'title' => 'Champagnes',
                        'description' => 'Champagnes de prestige'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/4.jpeg',
                        'title' => 'Service',
                        'description' => 'Service professionnel des vins'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/5.jpeg',
                        'title' => 'Cave à Vins',
                        'description' => 'Notre sélection exclusive'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/7.jpeg',
                        'title' => 'Dégustation',
                        'description' => 'Expérience de dégustation unique'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/8.jpeg',
                        'title' => 'Dégustation',
                        'description' => 'Expérience de dégustation unique'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/9.jpeg',
                        'title' => 'Dégustation',
                        'description' => 'Expérience de dégustation unique'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/10.jpeg',
                        'title' => 'Dégustation',
                        'description' => 'Expérience de dégustation unique'
                    ],
                    [
                        'image' => 'home/details/a13_vins_champagnes/11.jpeg',
                        'title' => 'Dégustation',
                        'description' => 'Expérience de dégustation unique'
                    ],
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
                'details' => [
                    [
                        'image' => 'home/details/a3_autres_resistances/1.jpeg',
                        'title' => 'Amiwo',
                        'description' => 'Pâte traditionnelle Amiwo préparée avec soin'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/2.jpeg',
                        'title' => 'Akassa',
                        'description' => 'Akassa traditionnelle servie avec sauce'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/3.png',
                        'title' => 'Attiéké',
                        'description' => 'Couscous de manioc traditionnel'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/4.jpeg',
                        'title' => 'Kpètè',
                        'description' => 'Kpètè traditionnel et ses accompagnements'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/5.jpeg',
                        'title' => 'Préparation',
                        'description' => 'Nos plats sont préparés avec des ingrédients frais'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/6.jpeg',
                        'title' => 'Service',
                        'description' => 'Une présentation soignée et traditionnelle'
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/7.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/8.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/9.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/10.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/11.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                    [
                        'image' => 'home/details/a3_autres_resistances/12.jpeg',
                        'title' => 'Service',
                        'description' => ''
                    ],
                ],
                'dishes' => [
                    [
                        'title' => 'Amiwo au poulet',
                        'price' => '4000 FCFA',
                        'description' => 'Pâte traditionnelle Amiwo servie avec une délicieuse sauce au poulet',
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
                'details' => [
                    [
                        'image' => 'home/details/a5_accompagnements/1.jpeg',
                        'title' => 'Pâtes Traditionnelles',
                        'description' => 'Sélection de pâtes traditionnelles africaines'
                    ],
                    [
                        'image' => 'home/details/a5_accompagnements/2.jpeg',
                        'title' => 'Riz et Dérivés',
                        'description' => 'Différentes préparations de riz'
                    ],
                    [
                        'image' => 'home/details/a5_accompagnements/3.jpeg',
                        'title' => 'Frites et Alloco',
                        'description' => 'Accompagnements frits variés'
                    ],
                    [
                        'image' => 'home/details/a5_accompagnements/4.jpeg',
                        'title' => 'Légumes',
                        'description' => 'Assortiment de légumes préparés'
                    ],
                    [
                        'image' => 'home/details/a5_accompagnements/5.jpeg',
                        'title' => 'Igname et Manioc',
                        'description' => 'Préparations à base d\'igname et de manioc'
                    ],
                    [
                        'image' => 'home/details/a5_accompagnements/6.jpeg',
                        'title' => 'Accompagnements Spéciaux',
                        'description' => 'Nos accompagnements signature'
                    ]
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
                'details' => [
                    [
                        'image' => 'home/details/a6_salades/1.jpeg',
                        'title' => 'Salade Composée',
                        'description' => 'Mélange frais de légumes de saison'
                    ],
                    [
                        'image' => 'home/details/a6_salades/2.jpeg',
                        'title' => 'Salade Mixte',
                        'description' => 'Assortiment varié de crudités et garnitures'
                    ],
                    [
                        'image' => 'home/details/a6_salades/3.jpeg',
                        'title' => 'Salade au Poulet',
                        'description' => 'Salade fraîche garnie de poulet grillé'
                    ],
                    [
                        'image' => 'home/details/a6_salades/4.jpeg',
                        'title' => 'Salade Floridale',
                        'description' => 'Salade exotique aux fruits et légumes'
                    ],
                    [
                        'image' => 'home/details/a6_salades/5.jpeg',
                        'title' => 'Salade Belle Saison',
                        'description' => 'Légumes frais de saison assortis'
                    ],
                    [
                        'image' => 'home/details/a6_salades/6.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ], 
                    [
                        'image' => 'home/details/a6_salades/7.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/8.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/9.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    // [
                    //     'image' => 'home/details/a6_salades/10.jpeg',
                    //     'title' => 'Service Soigné',
                    //     'description' => 'Présentation élégante de nos salades'
                    // ],
                    [
                        'image' => 'home/details/a6_salades/11.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/12.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/13.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/14.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
                    [
                        'image' => 'home/details/a6_salades/15.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos salades'
                    ],
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
                'details' => [
                    [
                        'image' => 'home/details/a7_fast_food/1.jpeg',
                        'title' => 'Chawama',
                        'description' => 'Délicieux sandwich grillé aux épices'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/2.jpeg',
                        'title' => 'Pizza Maison',
                        'description' => 'Nos pizzas préparées sur place'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/3.jpeg',
                        'title' => 'Hamburger',
                        'description' => 'Burger fait maison et ses accompagnements'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/7.jpeg',
                        'title' => 'Hot Dog',
                        'description' => 'Hot dog garni à votre goût'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/5.jpeg',
                        'title' => 'Sandwich Club',
                        'description' => 'Club sandwich multicouches'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/6.jpeg',
                        'title' => 'Service Rapide',
                        'description' => 'Préparation express et soignée'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/8.jpeg',
                        'title' => 'Service Rapide',
                        'description' => 'Préparation express et soignée'
                    ],
                    [
                        'image' => 'home/details/a7_fast_food/9.jpeg',
                        'title' => 'Service Rapide',
                        'description' => 'Préparation express et soignée'
                    ],
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
                'details' => [
                    [
                        'image' => 'home/details/a8_steaks/1.jpeg',
                        'title' => 'Steak au Poivre',
                        'description' => 'Steak de bœuf avec sa sauce au poivre noir'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/2.jpeg',
                        'title' => 'Émincé aux Champignons',
                        'description' => 'Émincé de filet aux champignons frais'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/3.jpeg',
                        'title' => 'Filet à la Crème',
                        'description' => 'Émincé de filet dans sa sauce crémeuse'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/4.jpeg',
                        'title' => 'Sauce Forestière',
                        'description' => 'Délicieuse sauce aux champignons des bois'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/5.jpeg',
                        'title' => 'Spaghettis Maison',
                        'description' => 'Pâtes fraîches avec sauces signature'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/6.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos plats'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/7.jpeg',
                        'title' => 'Steak au Poivre',
                        'description' => 'Steak de bœuf avec sa sauce au poivre noir'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/8.jpeg',
                        'title' => 'Émincé aux Champignons',
                        'description' => 'Émincé de filet aux champignons frais'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/9.jpeg',
                        'title' => 'Filet à la Crème',
                        'description' => 'Émincé de filet dans sa sauce crémeuse'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/10.jpeg',
                        'title' => 'Sauce Forestière',
                        'description' => 'Délicieuse sauce aux champignons des bois'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/11.jpeg',
                        'title' => 'Spaghettis Maison',
                        'description' => 'Pâtes fraîches avec sauces signature'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/12.jpeg',
                        'title' => 'Service Soigné',
                        'description' => 'Présentation élégante de nos plats'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/13.jpeg',
                        'title' => 'Steak au Poivre',
                        'description' => 'Steak de bœuf avec sa sauce au poivre noir'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/14.jpeg',
                        'title' => 'Émincé aux Champignons',
                        'description' => 'Émincé de filet aux champignons frais'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/15.jpeg',
                        'title' => 'Filet à la Crème',
                        'description' => 'Émincé de filet dans sa sauce crémeuse'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/16.jpeg',
                        'title' => 'Sauce Forestière',
                        'description' => 'Délicieuse sauce aux champignons des bois'
                    ],
                    [
                        'image' => 'home/details/a8_steaks/17.jpeg',
                        'title' => 'Spaghettis Maison',
                        'description' => 'Pâtes fraîches avec sauces signature'
                    ],
                    
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

    public function addToCart($dishTitle, $dishPrice)
    {
        $found = false;
        foreach ($this->cart as &$item) {
            if ($item['dish_name'] === $dishTitle) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $this->cart[] = [
                'dish_name' => $dishTitle,
                'price' => (float) str_replace(' FCFA', '', $dishPrice),
                'quantity' => 1,
                'notes' => ''
            ];
        }

        $this->emit('cartUpdated');
        $this->dispatchBrowserEvent('showToast', ['message' => 'Plat ajouté au panier']);
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->emit('cartUpdated');
    }

    public function updateQuantity($index, $change)
    {
        $this->cart[$index]['quantity'] = max(1, $this->cart[$index]['quantity'] + $change);
    }

    public function placeCommand()
    {
        $this->validate();

        try {
            // Création de la commande
            $command = Command::create([
                'customer_name' => $this->commandForm['customer_name'],
                'phone' => $this->commandForm['phone'],
                'email' => $this->commandForm['email'],
                'delivery_address' => $this->commandForm['delivery_address'],
                'notes' => $this->commandForm['notes'],
                'total_amount' => collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']),
                'status' => 'pending'
            ]);

            // Enregistrement des items de la commande
            foreach ($this->cart as $item) {
                CommandItem::create([
                    'command_id' => $command->id,
                    'dish_name' => $item['dish_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            // Envoi du mail aux gérants
            $managers = User::whereHas('roles', function ($query) {
                $query->where('name', 'Gérante');
            })->get();

            foreach ($managers as $manager) {
                Mail::to($manager->email)->send(new CommandMail($command, $this->cart, 'admin'));
            }

            // Envoi du mail de confirmation au client s'il a fourni un email
            if ($this->commandForm['email']) {
                Mail::to($this->commandForm['email'])->send(new CommandMail($command, $this->cart, 'client'));
            }

            // Réinitialisation du formulaire et du panier
            $this->reset(['cart', 'commandForm', 'showCommandForm']);
            
            // Message de succès
            // $this->dispatch('alert', [
            //     'type' => 'success',
            //     'message' => 'Votre commande a été enregistrée avec succès !'
            // ]);

            Alert::success('Votre commande a été enregistrée avec succès !');

        } catch (\Exception $e) {
            // Message d'erreur
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement de la commande.'
            ]);
        }

        return redirect()->route('home.page');
    }

    public function toggleCart()
    {
        $this->showCart = !$this->showCart;
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->emit('cartUpdated');
        $this->dispatchBrowserEvent('showToast', ['message' => 'Panier vidé']);
    }

    public function render()
    {
        return view('livewire.home.dashe-details-page')->extends('layouts.home')->section('content');
    }
}
