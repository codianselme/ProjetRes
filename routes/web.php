<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('accueil');
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    
    Route::group(['prefix' => 'admin'], function () {

        // Route::get('/',                     App\Http\Livewire\Dashboard\Index::class)->name('dashboard');
        // Route::get('permissions/',          App\Http\Livewire\Dashboard\Permissions\Permissions::class)->name('dashboard.permissions');
        // Route::get('profiles/',             App\Http\Livewire\Dashboard\Roles\Roles::class)->name('dashboard.roles');
        // Route::get('utilisateurs/',         App\Http\Livewire\Dashboard\Utilisateurs\Utilisateurs::class)->name('dashboard.utilisateurs');
        // Route::get('utilisateurs/archives', App\Http\Livewire\Dashboard\UtilisateursArchives\UtilisateursArchives::class)->name('dashboard.utilisateurs-archives');
        
        // Route::get('drink/category/', App\Http\Livewire\Dashboard\Drink\Category::class)->name('dashboard.drink.category');
        // Route::get('drink/supply/', App\Http\Livewire\Dashboard\Drink\Supply::class)->name('dashboard.drink.supply');
        // Route::get('food/category/', App\Http\Livewire\Dashboard\Food\Category::class)->name('dashboard.food.category');
        // Route::get('food/supply/', App\Http\Livewire\Dashboard\Food\Supply::class)->name('dashboard.food.supply');
        



        Route::get('/',                     App\Http\Livewire\Dashboard\Index::class)->name('dashboard');
        Route::get('permissions/',          App\Http\Livewire\Dashboard\Permissions\Permissions::class)->name('dashboard.permissions');
        Route::get('profiles/',             App\Http\Livewire\Dashboard\Roles\Roles::class)->name('dashboard.roles');
        
        Route::get('utilisateurs/',         App\Http\Livewire\Dashboard\Utilisateurs\Utilisateurs::class)->name('dashboard.utilisateurs');
        Route::get('utilisateurs/archives', App\Http\Livewire\Dashboard\UtilisateursArchives\UtilisateursArchives::class)->name('dashboard.utilisateurs-archives');
        
        Route::get('drink/category/', App\Http\Livewire\Dashboard\Drink\Category::class)->name('dashboard.drink.category');
        Route::get('drink/supply/', App\Http\Livewire\Dashboard\Drink\Supply::class)->name('dashboard.drink.supply');
       
        Route::get('food/category/', App\Http\Livewire\Dashboard\Food\Category::class)->name('dashboard.food.category');
        Route::get('food/supply/', App\Http\Livewire\Dashboard\Food\Supply::class)->name('dashboard.food.supply');
        
        Route::get('food/dish/', App\Http\Livewire\Dashboard\Food\Dishs::class)->name('dashboard.food.dish');

        Route::get('stock/drink/', App\Http\Livewire\Dashboard\Stock\Food::class)->name('dashboard.stock.food');
        Route::get('stock/food/', App\Http\Livewire\Dashboard\Stock\Drink::class)->name('dashboard.stock.drink');

    });
});
