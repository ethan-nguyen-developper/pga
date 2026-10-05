<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LocalisationController extends Controller
{
    public function index() {
        return Inertia::render('Localisation/Index');
    }

    // public function create() {
    //     return Inertia::render('Localisation/Create');
    // }

    // public function edit() {
    //     return Inertia::render('Localisation/Edit');
    // }
}
