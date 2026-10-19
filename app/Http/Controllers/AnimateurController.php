<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Animateur;
use App\Models\Localisation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $localisations = Localisation::all();

        return Inertia::render('Animateur/CreateAnimateur', [
            'localisations' => $localisations,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'age' => 'required|integer',
            'localisation_id' => 'required|exists:localisations,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $animateur = Animateur::create($validatedData);

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');

                $name = $animateur->nom . '_' . $animateur->prenom;

                $fileName = str_replace(
                    ' ',
                    '_',
                    $name
                ) . '.' . $photo->getClientOriginalExtension();

                $filePath = $photo->storeAs(
                    'photos',
                    $fileName,
                    'public'
                );

                $animateur->photo = $filePath;
                $animateur->save();
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Animateur ajouté avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'Une erreur est survenue lors de la création de l’animateur.'
                ]);
        }
    }

    public function edit(Animateur $animateur) {
        $localisations = Localisation::all();
        return Inertia::render('Animateur/EditAnimateur', [
            "localisations" => $localisations,
            "animateur" => $animateur
        ]);
    }

    public function update(Request $request, Animateur $animateur)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'age' => 'required|integer',
            'localisation_id' => 'required|exists:localisations,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Ne pas enregistrer la photo avec les autres champs
            unset($validatedData['photo']);

            $animateur->update($validatedData);

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');

                // Supprimer l'ancienne photo si elle existe
                if ($animateur->photo) {
                    Storage::disk('public')->delete($animateur->photo);
                }

                $name = str_replace(
                    ' ',
                    '_',
                    $animateur->nom . '_' . $animateur->prenom
                );

                $fileName = $name . '_' . uniqid()
                    . '.' . $photo->getClientOriginalExtension();

                $filePath = $photo->storeAs(
                    'photos',
                    $fileName,
                    'public'
                );

                $animateur->photo = $filePath;
                $animateur->save();
            }

            DB::commit();

            return redirect()
                ->route('animateur.index')
                ->with('success', 'Animateur modifié avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();

            report($e);

            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'Une erreur est survenue lors de la modification de l’animateur.',
                ]);
        }
    }
}
