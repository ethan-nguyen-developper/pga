<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Animateur;
use App\Models\Localisation;

class AnimateurController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        $per_page = (int) $request->input('per_page', 5);

        if (!in_array($per_page, [5, 10, 20, 50, 100])) {
            $per_page = 5;
        }

        $animateurs = Animateur::with('localisation')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%");
                });
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where('localisation_id', $filter);
            })
            ->latest()
            ->paginate($per_page)
            ->withQueryString();

        $localisations = Localisation::all();

        return Inertia::render('Animateur/IndexAnimateur', [
            'animateurs' => $animateurs,
            'localisations' => $localisations,
            'filtres' => [
                'search' => $search,
                'filter' => $filter,
                'per_page' => $per_page,
            ],
        ]);
    }

    public function create() {
        return Inertia::render('Animateur/CreateAnimateur');
    }

    public function edit() {
        return Inertia::render('Animateur/EditAnimateur');
    }
}
