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

Route::get('/', [EvenementController::class,'index'])->name('home');

//gestion des evenements
Route::get('/addevents', [EvenementController::class, 'create'])->name('addevent');
Route::post('evenement/ajouter', [EvenementController::class, 'store']);
Route::get('evenement/update/{id}', [EvenementController::class, 'edit']);
Route::post('evenement/modifier/{id}', [EvenementController::class, 'update']);
Route::get('evenement/supprimer/{id}', [EvenementController::class, 'destroy']);
Route::get('evenement/cloturer/{id}', [EvenementController::class, 'cloture']);

 //gestion des reservations
Route::put('/reservation/decline/{id}', [ReservationController::class, 'decline']);
Route::post('/reserver', [ReservationController::class, 'store']);
Route::get('/myreservation', [ReservationController::class, 'index']);
Route::post('/evenement/reservations', [ReservationController::class, 'show']);



Route::middleware('multiauth')->group(function () {
    Route::get('/dashboard',[EvenementController::class, 'events'])->name('dashboard');

    Route::get('/myevents',[EvenementController::class, 'show'])->name('myevents');
    
    //gestions des utilisateurs
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profileadmin', [ProfileAdminController::class, 'edit'])->name('profileadmin.edit');
    Route::patch('/profileadmin', [ProfileAdminController::class, 'update'])->name('profileadmin.update');
    Route::delete('/profileadmin', [ProfileAdminController::class, 'destroy'])->name('profileadmin.destroy');

    Route::get('/deconnect', [AssociationController::class, 'destroy1'])
                    ->name('deconnect');
});

require __DIR__.'/auth.php';
