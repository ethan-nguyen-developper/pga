<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Localisation;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class LocalisationController extends Controller
{
    public function index() {
        $localisations = Localisation::latest()->paginate(5);
        return Inertia::render('Localisation/IndexLocalisation', [
            "localisations" => $localisations
        ]);
    }

    public function edit(Localisation $localisation) {
        return response()->json(["localisation" => $localisation]);
    }

    public function store(Request $request) {
        $request->validate([
            "ville" => "required|unique:App\\Models\Localisation"
        ]);

        Localisation::create(["ville" => $request->ville]);

        return redirect()->back();
    }

    public function update(Request $request, Localisation $localisation)
    {
        $validated = $request->validate([
            'ville' => [
                'required',
                'string',
                'max:255',
                Rule::unique('localisations', 'ville')
                    ->ignore($localisation->id),
            ],
        ]);

        try {
            $localisation->update($validated);

            return redirect()
                ->back()
                ->with('success', 'Localisation modifiée avec succès !');

        } catch (QueryException $e) {

            if (
                isset($e->errorInfo[1]) &&
                (int) $e->errorInfo[1] === 1062
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'ville' => 'Cette localisation existe déjà.',
                    ]);
            }

            return redirect()
                ->back()
                ->withErrors([
                    'ville' => 'Impossible de modifier la localisation.',
                ]);
        }
    }

    public function delete(Localisation $localisation)
    {
        if ($localisation->animateurs()->exists()) {
            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'Cette localisation ne peut pas être supprimée car des animateurs en dépendent.'
                ]);
        }

        $localisation->delete();

        return redirect()
            ->back()
            ->with('success', 'Localisation supprimée avec succès !');
    }
}
