<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permissions as ModelsPermissions;

class permissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_permissions()
    {
        $permissions = ModelsPermissions::get();
        return response()->json([
            "status" => 1,
            "message" => "Liste des permissions",
            "data" => $permissions
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_permissions(Request $request)
    {
        // Validation
        $request->validate([
            "name" => "required|string|unique:permissions",
            "description" => "required|string"
        ]);

        // Création d'une permission
        $permission = new ModelsPermissions();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        // Réponse
        return response()->json([
            "status" => 1,
            "message" => "Permission enregistrée avec succès"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function get_permissions(string $id)
    {
        // Vérifier si la permission existe
        $permission = ModelsPermissions::find($id);

        if ($permission) {
            return response()->json([
                "status" => 1,
                "message" => "Permission trouvée",
                "data" => $permission
            ], 200);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_permissions(Request $request, string $id)
    {
        // Vérifier si la permission existe
        $permission = ModelsPermissions::find($id);

        if ($permission) {
            // Mettre à jour les informations de la permission
            $permission->name = $request->name;
            $permission->description = $request->description;
            $permission->save();

            return response()->json([
                "status" => 1,
                "message" => "Mise à jour réussie",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Permission introuvable"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_permissions(string $id)
    {
        // Vérifier si la permission existe
        $permission = ModelsPermissions::find($id);

        if ($permission) {
            // Supprimer la permission
            $permission->delete();

            return response()->json([
                "status" => 1,
                "message" => "Permission supprimée avec succès",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }
}
