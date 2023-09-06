<?php

use App\Http\Controllers\AddController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//Login
Route::post('/login', [AuthentificationController::class, 'Login']);
Route::get('/logout', [AuthentificationController::class, 'Logout']);

//Inscription
Route::post('/signin', [AuthentificationController::class, 'SignIn']);
Route::get('/check-email', [AuthentificationController::class,'checkEmail']);

//Language
Route::get('/ChangeLanguage', [AuthentificationController::class,'changeLanguage']);

//Ajout
Route::get('/PageAjoutTache', [AddController::class, 'PageAjoutTache']);
Route::post('/ConfirmeAjoutTache', [AddController::class, 'AjoutTache']);

Route::get('/PageAjoutSousTache/{id}', [AddController::class, 'PageAjoutSousTache']);
Route::post('/ConfirmeAjoutSousTache', [AddController::class, 'AjoutSousTache']);

//Liste
Route::get('/Tache', [ListController::class, 'ListeTache']);
Route::get('/DetailsTache/{id}', [ListController::class, 'DetailsTache']);
Route::get('/TacheToday', [ListController::class, 'ListeTacheToday']);
Route::post('/RechercheTache', [ListController::class, 'RechercheTache']);

Route::get('/Corbeille', [ListController::class, 'Corbeille']);

Route::get('/Parametre', [ListController::class, 'Parametre']);



//modifier
Route::post('/ModifierTache', [UpdateController::class, 'ModifierTache']);
Route::get('/DeleteSubTask/{id}', [DeleteController::class, 'DeleteSubTask']);

Route::get('/PageModifierSousTache/{id}', [UpdateController::class, 'PageModifierSousTache']);
Route::post('/ConfirmeModifierSousTache', [UpdateController::class, 'ModifierSousTache']);

Route::get('/DeleteTask/{id}', [DeleteController::class, 'DeleteTask']);
Route::get('/DeleteTaskDefinitive/{id}', [DeleteController::class, 'DeleteTaskDefinitive']);
Route::get('/DeleteAll', [DeleteController::class, 'DeleteAll']);

Route::get('/RestoreTask/{id}', [DeleteController::class, 'RestoreTask']);
Route::get('/RestoreAll', [DeleteController::class, 'RestoreAll']);

Route::post('/ModifierUtilisateur', [UpdateController::class, 'ModifierUtilisateur']);
Route::get('/checkEmailForUpdate', [UpdateController::class,'checkEmailForUpdate']);
Route::get('/checkPasswordForUpdate', [UpdateController::class,'checkPasswordForUpdate']);

Route::post('/ModifierUtilisateurMDP', [UpdateController::class, 'ModifierUtilisateurMDP']);










