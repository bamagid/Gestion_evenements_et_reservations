<?php

use App\Http\Controllers\auth\AssociationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:association', 'verified'])->name('dashboard');

Route::get('/addevents', [EvenementController::class, 'create'])->name('addevent');
Route::post('evenement/ajouter', [EvenementController::class, 'store']);
Route::get('evenement/modifier', [EvenementController::class, 'edit']);
Route::post('evenement/modifier/{id}', [EvenementController::class, 'update']);
Route::get('evenement/supprimer/{id}', [EvenementController::class, 'destroy']);
Route::middleware('multiauth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/deconnect', [AssociationController::class, 'destroy1'])
                    ->name('deconnect');
});

require __DIR__.'/auth.php';
