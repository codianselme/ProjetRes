<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DrinkSuppliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $drink_supplies_liste = [
            [
                'drink_name' => 'Béninoise (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Pils (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Beaufort (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Eku (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ], 
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Castel (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Flag (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Guiness (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],

            [
                'drink_name' => 'Dopel Noir (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 6,
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Sucreries : coca (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            [
                'drink_name' => 'Sucreries : sprite (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            [
                'drink_name' => 'Sucreries : youki (0,33 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Sucreries : coca (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            [
                'drink_name' => 'Sucreries : sprite (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            [
                'drink_name' => 'Sucreries : youki (0,60 cl)',
                'unit' => 'Cl',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 7,
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Aquabelle (0,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            [
                'drink_name' => 'Fifa (0,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            [
                'drink_name' => 'Possotome (0,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Comtesse (1,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            [
                'drink_name' => 'Aquabelle (1,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            [
                'drink_name' => 'kwabo (1,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            [
                'drink_name' => 'Fifa (1,5 L)',
                'unit' => 'L',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 2,
            ],

            // -------------------------------------------------------------------

            [
                'drink_name' => 'Amura',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Campari',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Cardhu',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Cointreau',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Chivas régal 12/18',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Chivas régal 12/18',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Dimple',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Island green',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Jack Daniel\'s',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Label 5',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Martini',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Moulin de la grange',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Red Label',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Saint James',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
            [
                'drink_name' => 'Suze',
                'unit' => '',
                'supplier_name' => '-',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
                'supply_date' => Carbon::now()->format('Y-m-d'),
                'category_id' => 5,
            ],
        ];



        $drink_stocks = [
            [
                'drink_name' => 'Béninoise (0,33 cl)',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
            ],

            [
                'drink_name' => 'Pils (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ],

            [
                'drink_name' => 'Beaufort (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ],

            [
                'drink_name' => 'Eku (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ], 
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Castel (0,60 cl)',                                
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,                                
            ],

            [
                'drink_name' => 'Flag (0,60 cl)',                                
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,                                
            ],

            [
                'drink_name' => 'Guiness (0,60 cl)',                                
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,                                
            ],

            [
                'drink_name' => 'Dopel Noir (0,60 cl)',                                
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,                                
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Sucreries : coca (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ],
            [
                'drink_name' => 'Sucreries : sprite (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ],
            [
                'drink_name' => 'Sucreries : youki (0,33 cl)',                                
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,                                
            ],
            
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Sucreries : coca (0,60 cl)',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,

            ],
            [
                'drink_name' => 'Sucreries : sprite (0,60 cl)',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Sucreries : youki (0,60 cl)',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Aquabelle (0,5 L)',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
            ],

            [
                'drink_name' => 'Fifa (0,5 L)',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
            ],

            [
                'drink_name' => 'Possotome (0,5 L)',
                'quantity' => 100,
                'unit_price' => 500,
                'total_cost' => 50000,
            ],
            // -------------------------------------------------------------------
            [
                'drink_name' => 'Comtesse (1,5 L)',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
            ],

            [
                'drink_name' => 'Aquabelle (1,5 L)',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
            ],

            [
                'drink_name' => 'kwabo (1,5 L)',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
            ],

            [
                'drink_name' => 'Fifa (1,5 L)',
                'quantity' => 100,
                'unit_price' => 1000,
                'total_cost' => 100000,
            ],

            // -------------------------------------------------------------------

            [
                'drink_name' => 'Amura',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Campari',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Cardhu',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
            ],
            [
                'drink_name' => 'Cointreau',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
            ],
            [
                'drink_name' => 'Chivas régal 12/18',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
            ],
            [
                'drink_name' => 'Chivas régal 12/18',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
            ],
            [
                'drink_name' => 'Dimple',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
            ],
            [
                'drink_name' => 'Island green',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
            ],
            [
                'drink_name' => 'Jack Daniel\'s',
                'quantity' => 100,
                'unit_price' => 5000,
                'total_cost' => 500000,
            ],
            [
                'drink_name' => 'Label 5',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Martini',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Moulin de la grange',
                'quantity' => 100,
                'unit_price' => 10000,
                'total_cost' => 1000000,
            ],
            [
                'drink_name' => 'Red Label',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Saint James',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
            [
                'drink_name' => 'Suze',
                'quantity' => 100,
                'unit_price' => 1500,
                'total_cost' => 150000,
            ],
        ];

        // Insertion dans la table drink_supplies
        DB::table('drink_supplies')->insert($drink_supplies_liste);
        DB::table('drink_stocks')->insert($drink_stocks);
    }
}
