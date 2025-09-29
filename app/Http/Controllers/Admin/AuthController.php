<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login ou création d’utilisateur
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'nullable|string'
        ]);

        // Vérifie si l'utilisateur existe
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Utilisateur existant
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'exists' => true,
                'message' => 'Utilisateur existant, redirection vers stats',
                'user' => $user,
                'token' => $token
            ]);
        }

        // Nouveau utilisateur : nom obligatoire
        if (!$request->name) {
            return response()->json([
                'exists' => false,
                'message' => 'Nom requis pour créer le compte'
            ], 422);
        }

        // Création de l'utilisateur sans password
        try {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
            ]);

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'exists' => false,
                'message' => 'Compte créé avec succès',
                'user' => $user,
                'token' => $token
            ], 201);

        } catch (\Exception $e) {
            // Retourne l’erreur exacte pour debug
            return response()->json([
                'message' => 'Erreur serveur : ' . $e->getMessage()
            ], 500);
        }
    }
}
