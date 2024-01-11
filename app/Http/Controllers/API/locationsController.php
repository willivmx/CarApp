<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\locations;
use App\Models\locations as Modelslocations;

class locationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_locations()
    {
        $locations = Modelslocations::get();
        return response()->json([
            "status" => 1,
            "message" => "Liste des locations",
            "data" => $locations
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_location(Request $request)
    {
        // Validation
        $request->validate([
            "utilisateur_id" => "required|exists:utilisateurs,id",
            "voiture_id" => "required|exists:automobiles,id",
            "date_debut" => "required|date",
            "date_fin" => "required|date|after_or_equal:date_debut",
            "cout" => "required|numeric",
        ]);

         // Création d'une location
         $location = new Modelslocations();
         $location->utilisateur_id = $request->utilisateur_id;
         $location->voiture_id = $request->voiture_id;
         $location->date_debut = $request->date_debut;
         $location->date_fin = $request->date_fin;
         $location->cout = $request->cout;
         $location->statut = 'en_cours';
         $location->save();

         // Réponse
        return response()->json([
            "status" => 1,
            "message" => "Location enregistrée avec succès"
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
    public function get_location(string $id)
    {
        // Vérifier si la location existe
        $location = Modelslocations::find($id);

        if ($location) {
            return response()->json([
                "status" => 1,
                "message" => "Location trouvée",
                "data" => $location
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
    public function update_location(Request $request, string $id)
    {
         // Vérifier si la location existe
         $location = Modelslocations::find($id);

         if ($location) {
             // Mettre à jour les informations de la location
             $location->utilisateur_id = $request->utilisateur_id;
             $location->voiture_id = $request->voiture_id;
             $location->date_debut = $request->date_debut;
             $location->date_fin = $request->date_fin;
             $location->cout = $request->cout;
             $location->statut = $request->statut;
             $location->save();

             return response()->json([
                 "status" => 1,
                 "message" => "Mise à jour réussie",
             ]);
         } else {
             return response()->json([
                 "status" => 0,
                 "message" => "Location introuvable"
             ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_location(string $id)
    {
        // Vérifier si la location existe
        $location = Modelslocations::find($id);

        if ($location) {
            // Supprimer la location
            $location->delete();

            return response()->json([
                "status" => 1,
                "message" => "Location supprimée avec succès",
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée"
            ], 404);
        }
    }
}
