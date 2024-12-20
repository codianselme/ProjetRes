<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserTableSeeder::class);

        $this->call(DrinkCategorySeeder::class);
        $this->call(DrinkSuppliesSeeder::class);

        $this->call(FoodCategorySeeder::class);

        $this->call(DishCategorySeeder::class);
        $this->call(DishesSeeder::class);
        
        $this->call(ParametreSeeder::class);
        

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
