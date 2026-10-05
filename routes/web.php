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
// Route::get('/animateur/edit', [AnimateurController::class, "edit"])->name("animateur.edit");

Route::get('/localisation', [LocalisationController::class, "index"])->name("localisation.index");
// Route::get('/localisation/create', [LocalisationController::class, "create"])->name("localisation.create");
// Route::get('/localisation/edit', [LocalisationController::class, "edit"])->name("localisation.edit");