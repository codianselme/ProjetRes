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

        Route::get('/',                     App\Http\Livewire\Dashboard\Index::class)->name('dashboard');
        Route::get('permissions/',          App\Http\Livewire\Dashboard\Permissions\Permissions::class)->name('dashboard.permissions');
        Route::get('profiles/',             App\Http\Livewire\Dashboard\Roles\Roles::class)->name('dashboard.roles');
        Route::get('utilisateurs/',         App\Http\Livewire\Dashboard\Utilisateurs\Utilisateurs::class)->name('dashboard.utilisateurs');
        Route::get('utilisateurs/archives', App\Http\Livewire\Dashboard\UtilisateursArchives\UtilisateursArchives::class)->name('dashboard.utilisateurs-archives');

    });
});
