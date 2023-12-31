<?php

use App\Http\Controllers\auth\AssociationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', [EvenementController::class, 'index'])->name('home');

Route::middleware('multiauth:association')->group(function () {

    //gestion des evenements
    Route::get('/addevents', [EvenementController::class, 'create'])->name('addevent');
    Route::post('evenement/ajouter', [EvenementController::class, 'store']);
    Route::get('/myevents', [EvenementController::class, 'show'])->name('myevents');
    Route::get('evenement/update/{id}', [EvenementController::class, 'edit']);
    Route::post('evenement/modifier/{id}', [EvenementController::class, 'update']);
    Route::get('evenement/supprimer/{id}', [EvenementController::class, 'destroy']);
    Route::get('evenement/cloturer/{id}', [EvenementController::class, 'cloture']);

    //gestion des reservations
    Route::post('/reservation/decline', [ReservationController::class, 'decline']);
    Route::post('/reserver/evenement', [ReservationController::class, 'store']);
    Route::get('/myreservation', [ReservationController::class, 'index']);
    Route::post('/evenement/reservations', [ReservationController::class, 'show']);


    Route::get('/dashboard', [EvenementController::class, 'events'])->name('dashboard');



    //gestions des utilisateurs
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update']);

    Route::get('/profile/delete', [ProfileController::class, 'delete']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/deconnect', [AssociationController::class, 'destroy1'])
        ->name('deconnect');
});

require __DIR__ . '/auth.php';
