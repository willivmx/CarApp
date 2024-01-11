<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\utilisateurs as ModelsUtilisateurs;
use Illuminate\Support\Facades\Hash;

class utilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_utilisateurs()
    {
        $utilisateurs = ModelsUtilisateurs::get();
        return response()->json([
            "status" => 1,
            "message" => "Liste des utilisateurs",
            "data" => $utilisateurs
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_utilisateur(Request $request)
    {
        // Validation
        $request->validate([
            "nom" => "required|string",
            "prenom" => "required|string",
            "email" => "required|email|unique:utilisateurs",
            "password" => "required|string|min:6",
        ]);

        // Création d'un utilisateur
        $utilisateur = new ModelsUtilisateurs();
        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->password = Hash::make($request->password);
        $utilisateur->save();

        // Réponse
        return response()->json([
            "status" => 1,
            "message" => "Utilisateur enregistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function get_utilisateur(string $id)
    {
        // Vérification si l'utilisateur existe
        $utilisateur = ModelsUtilisateurs::find($id);

        if ($utilisateur) {
            return response()->json([
                "status" => 1,
                "message" => "Utilisateur trouvé",
                "data" => $utilisateur
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_utilisateur(Request $request, string $id)
    {
        // Vérification si l'utilisateur existe
        $utilisateur = ModelsUtilisateurs::find($id);

        if ($utilisateur) {
            // Validation
            $request->validate([
                "nom" => "required|string",
                "prenom" => "required|string",
                "email" => "required|email|unique:utilisateurs,email," . $id,
                "password" => "nullable|string|min:6",
            ]);

            // Mettre à jour les informations de l'utilisateur
            $utilisateur->nom = $request->nom;
            $utilisateur->prenom = $request->prenom;
            $utilisateur->email = $request->email;

            // Mettre à jour le mot de passe uniquement s'il est fourni
            if ($request->has('password')) {
                $utilisateur->password = Hash::make($request->password);
            }

            $utilisateur->save();

            return response()->json([
                "status" => 1,
                "message" => "Mise à jour réussie",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Utilisateur introuvable"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_utilisateur(Request $request, string $id)
    {
        // Vérifier si l'utilisateur existe
        $utilisateur = ModelsUtilisateurs::find($id);

        if ($utilisateur) {
            // Si l'utilisateur connecté est administrateur ou supprime son propre compte
            if ($request->user()->isAdmin() || $request->user()->id == $id) {
                // Soft delete
                $utilisateur->delete();

                return response()->json([
                    "status" => 1,
                    "message" => "Utilisateur supprimé avec succès",
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "Vous n'avez pas les autorisations pour supprimer cet utilisateur",
                ], 403);
            }
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }
}
