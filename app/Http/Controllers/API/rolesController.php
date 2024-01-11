<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\roles as ModelsRoles;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_roles()
    {
        $roles = ModelsRoles::get();
        return response()->json([
            "status" => 1,
            "message" => "Liste des rôles",
            "data" => $roles
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_roles(Request $request)
    {
        // Validation
        $request->validate([
            "name" => "required|string|unique:roles",
            "description" => "required|string"
        ]);

        // Création d'un rôle
        $role = new ModelsRoles();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        // Réponse
        return response()->json([
            "status" => 1,
            "message" => "Rôle enregistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function get_roles(string $id)
    {
        // Vérifier si le rôle existe
        $role = ModelsRoles::find($id);

        if ($role) {
            return response()->json([
                "status" => 1,
                "message" => "Rôle trouvé",
                "data" => $role
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
    public function update_roles(Request $request, string $id)
    {
        // Vérifier si le rôle existe
        $role = ModelsRoles::find($id);

        if ($role) {
            // Mettre à jour les informations du rôle
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            return response()->json([
                "status" => 1,
                "message" => "Mise à jour réussie",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Rôle introuvable"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_roles(string $id)
    {
        // Vérifier si le rôle existe
        $role = ModelsRoles::find($id);

        if ($role) {
            // Supprimer le rôle
            $role->delete();

            return response()->json([
                "status" => 1,
                "message" => "Rôle supprimé avec succès",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }
}
