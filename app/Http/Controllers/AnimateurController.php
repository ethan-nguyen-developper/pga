<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimateurController extends Controller
{
    public function index() {
        return Inertia::render('Animateur/Index');
    }

    public function create() {
        return Inertia::render('Animateur/Create');
    }

    // public function edit() {
    //     return Inertia::render('Animateur/Edit');
    // }
}
