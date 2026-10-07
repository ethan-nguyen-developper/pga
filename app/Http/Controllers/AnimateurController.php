<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Animateur;

class AnimateurController extends Controller
{
    public function index() {
        $animateurs = Animateur::with("localisation")->latest()->paginate(5);
        return Inertia::render('Animateur/IndexAnimateur', ["animateurs" => $animateurs]);
    }

    public function create() {
        return Inertia::render('Animateur/CreateAnimateur');
    }

    public function edit() {
        return Inertia::render('Animateur/EditAnimateur');
    }
}
