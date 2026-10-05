<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Test');
})->name("home");

Route::get('/contact', function () {
    return Inertia::render('Test2');
})->name("contact");