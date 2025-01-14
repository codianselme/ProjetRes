<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class DetailsPage extends Component
{
    public $slug;
    public $details;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->details = $this->getDetails($slug);
    }

    private function getDetails($slug)
    {
        // Catalogue statique des détails
        $catalog = [
            'igname_pilee_sauce_claire_togo' => [
                'title' => 'Igname Pilée & Sauce Claire du Togo',
                'description' => 'L\'igname pilée est un plat traditionnel togolais servi avec une sauce claire savoureuse. Ce plat emblématique est préparé à partir d\'igname fraîche, pilée jusqu\'à obtention d\'une texture lisse et élastique.',
                'price' => '3000 FCFA',
                'images' => [
                    asset('home/pub/a9.jpeg'),
                    asset('home/pub/8.jpeg'),
                    asset('home/pub/20.jpeg')
                ],
                'ingredients' => ['Igname', 'Poisson fumé', 'Épinards', 'Épices traditionnelles'],
                'preparation_time' => '30 minutes'
            ],
            'les_steaks' => [
                'title' => 'Les Steaks',
                'description' => 'Nos steaks sont soigneusement sélectionnés et préparés selon vos préférences. Chaque pièce est grillée à la perfection pour garantir une expérience gustative exceptionnelle.',
                'price' => '5000 FCFA',
                'images' => [
                    asset('home/pub/x.jpeg'),
                    asset('home/pub/a7.jpeg')
                ],
                'ingredients' => ['Bœuf de qualité supérieure', 'Épices', 'Accompagnements au choix'],
                'preparation_time' => '20 minutes'
            ],
            'nos_sauces' => [
                'title' => 'Nos Sauces',
                'description' => 'Découvrez notre sélection de sauces traditionnelles et modernes, préparées avec des ingrédients frais et des recettes authentiques.',
                'price' => '1500 FCFA',
                'images' => [
                    asset('home/pub/9.jpeg'),
                    asset('home/pub/a5.jpeg')
                ],
                'ingredients' => ['Tomates fraîches', 'Épices locales', 'Herbes aromatiques'],
                'preparation_time' => '45 minutes'
            ],
            // Ajoutez d'autres éléments selon vos besoins
        ];

        return $catalog[$slug] ?? null;
    }

    public function render()
    {
        if (!$this->details) {
            return redirect()->route('home.page');
        }

        return view('livewire.home.details-page')->extends('layouts.home')->section('content');
    }
}
