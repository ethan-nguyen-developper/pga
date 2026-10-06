<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Localisation;

class LocalisationController extends Controller
{
    public function index() {
        $localisations = Localisation::orderBy("ville", "ASC")->paginate(2);
        return Inertia::render('Localisation/Index', [
            "localisations" => $localisations
        ]);
    }

    // public function create() {
    //     return Inertia::render('Localisation/Create');
    // }

    // public function edit() {
    //     return Inertia::render('Localisation/Edit');
    // }
}
