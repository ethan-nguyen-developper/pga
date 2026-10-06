<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Localisation;

class LocalisationController extends Controller
{
    public function index() {
        $localisations = Localisation::latest()->paginate(5);
        return Inertia::render('Localisation/IndexLocalisation', [
            "localisations" => $localisations
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            "ville" => "required|unique:App\\Models\Localisation"
        ]);

        Localisation::create(["ville" => $request->ville]);

        return redirect()->back();
    }
}
