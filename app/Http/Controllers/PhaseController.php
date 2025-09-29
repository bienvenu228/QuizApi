<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phase;

class PhaseController extends Controller
{
    /**
     * Affiche toutes les phases.
     */
    public function index()
    {
        $phases = Phase::all();
        return response()->json($phases);
    }

    /**
     * Crée une nouvelle phase.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $phase = Phase::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Phase créée avec succès',
            'phase' => $phase
        ], 201);
    }

    /**
     * Affiche une phase spécifique.
     */
    public function show(string $id)
    {
        $phase = Phase::find($id);

        if (!$phase) {
            return response()->json(['message' => 'Phase non trouvée'], 404);
        }

        return response()->json($phase);
    }

    /**
     * Met à jour une phase existante.
     */
    public function update(Request $request, string $id)
    {
        $phase = Phase::find($id);

        if (!$phase) {
            return response()->json(['message' => 'Phase non trouvée'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $phase->update($request->only(['title', 'description']));

        return response()->json([
            'message' => 'Phase mise à jour avec succès',
            'phase' => $phase
        ]);
    }

    /**
     * Supprime une phase existante.
     */
    public function destroy(string $id)
    {
        $phase = Phase::find($id);

        if (!$phase) {
            return response()->json(['message' => 'Phase non trouvée'], 404);
        }

        $phase->delete();

        return response()->json(['message' => 'Phase supprimée avec succès']);
    }
}
