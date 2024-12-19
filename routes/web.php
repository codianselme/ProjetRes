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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('accueil');
// });

// Route::get('/', function () {
//     return view('layouts.home');
// });


Route::get('/',  \App\Http\Livewire\Home\HomePage::class)->name('home.page');
Route::get('/contact',  \App\Http\Livewire\Home\ContactPage::class)->name('contact.page');
Route::get('/a propos',  \App\Http\Livewire\Home\AboutPage::class)->name('about.page');
Route::get('/reservation',  \App\Http\Livewire\Home\ReservationPage::class)->name('reservation.page');
Route::get('/connexion',  \App\Http\Livewire\Home\Login::class)->name('connexion.page');

# Pour les envois de mails
Route::get('/activation/{token}', [App\Http\Controllers\Utilisateurs\AuthController::class, 'activation'])->name('activation');
Route::get('/activate/{token}',   [App\Http\Controllers\Utilisateurs\AuthController::class, 'activate'])->name('activate');
Route::post('/setpassword',       [App\Http\Controllers\Utilisateurs\AuthController::class, 'setPassword'])->name('setpassword');
Route::post('/forgotpassword',    [App\Http\Controllers\Utilisateurs\AuthController::class, 'forgotPassword'])->name('forgot.password');

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
        
        Route::get('sales/', App\Http\Livewire\Dashboard\Sales\Sales::class)->name('dashboard.sales.sales');
        Route::get('commands/', App\Http\Livewire\Dashboard\Orders\Orders::class)->name('dashboard.gestion.commands');
        
        Route::get('repports/sales/',  App\Http\Livewire\Dashboard\Repports\RSale::class)->name('dashboard.repport.sales');
        Route::get('repports/supply/', App\Http\Livewire\Dashboard\Repports\RSupply::class)->name('dashboard.repport.supply');
        
        Route::get('profile', App\Http\Livewire\Dashboard\Profile\Profile::class)->name('dashboard.profile');
        
        Route::get('caisse/operation', App\Http\Livewire\Dashboard\Caisse\Depenses::class)->name('dashboard.caisse.depenses');
        Route::get('caisse/gestion', App\Http\Livewire\Dashboard\Caisse\GestionCaisse::class)->name('dashboard.caisse.gestion-caisse');

    });
});
