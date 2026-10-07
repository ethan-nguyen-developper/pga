<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AnimateurController;
use App\Http\Controllers\LocalisationController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name("home");

Route::get('/animateur', [AnimateurController::class, "index"])->name("animateur.index");
Route::get('/animateur/create', [AnimateurController::class, "create"])->name("animateur.create");

Route::get('/localisation', [LocalisationController::class, "index"])->name("localisation.index");
Route::get('/localisation/edit/{localisation}', [LocalisationController::class, "edit"])->name("localisation.edit");
Route::post('/localisation', [LocalisationController::class, "store"])->name("localisation.store");
Route::put('/localisations/{localisation}', [LocalisationController::class, 'update'])->name('localisation.update');
Route::delete('/localisations/{localisation}', [LocalisationController::class, 'delete'])->name('localisation.delete');