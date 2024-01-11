<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\automobiles;
use App\Models\automobiles as ModelsAutomobiles;

class automobilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function liste_automobiles()
    {
        {
            $automobiles = ModelsAutomobiles::get();
            return response()->json([
                "status" => 1,
                "message" => "liste des abonnés",
                "date" => $automobiles
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_automobile(Request $request)
    {
        //return $request;
        //validation

        $request->validate([
            "marque" => "required|string",
            "modele" => "required|string",
            "annee_fabrication" => "required|integer",
            "numero_plaque" => "required|string|unique:automobiles",
            "couleur" => "required|string",
            "type_carburant" => "required|string",
            "kilometrage" => "required|nullable|integer"
            ]);

            //creation d'un abonné
            $automobile = new ModelsAutomobiles();
            $automobile->marque = $request->marque;
            $automobile->modele = $request->modele;
            $automobile->annee_fabrication = $request->annee_fabrication;
            $automobile->numero_plaque = $request->numero_plaque;
            $automobile->couleur = $request->couleur;
            $automobile->type_carburant = $request->type_carburant;
            $automobile->kilometrage = $request->kilometrage;
            $automobile->save();


            //renvoie de réponse
            return response()->json(
                [
                    "status" => 1,
                    "message" => "automobile enregistré avec succèss"
                ]
            );

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
    public function get_automobile(string $id)
    {
        //verifier si un abonné a cet ID
        $automobile = ModelsAutomobiles::where('id',$id)->exists();
        if($automobile)
        {
            $info = ModelsAutomobiles::find($id);

            return response()->json(
                [
                    "status" => 1,
                    "message" => "automobile trouvé",
                    "data" => $info
                ],
        200);

        }else
        {
            return response()->json(
                [
                    "status" => 0,
                    "message" => "aucune donnée trouvée"
                ],
        404);
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
    public function update_automobile(Request $request, string $id)
    {
        //vérifie si l'abonnés existe d'abord
        $automobile = ModelsAutomobiles::where('id',$id)->exists();
        if($automobile)
        {
            $info = ModelsAutomobiles::find($id);
            $info->marque = $request->marque;
            $info->modele = $request->modele;
            $info->annee_fabrication = $request->annee_fabrication;
            $info->numero_plaque = $request->numero_plaque;
            $info->couleur = $request->couleur;
            $info->kilometrage = $request->kilometrage;
            $info->numero_plaque = $request->numero_plaque;
            $info->statut = $request->statut;
            $info->save();

            return response()->json(
                [
                    "status" => 1,
                    "message" => "Mis a jour reussie",
                ]);

        }else
        {
            return response()->json(
                [
                    "status" => 0,
                    "message" => "abonné introuvable"
                ]);


        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_automobile(string $id)
    {
        $automobile = ModelsAutomobiles::where('id',$id)->exists();
        if($automobile)
        {
            $automobile = ModelsAutomobiles::find($id);

            $automobile -> delete();

            return response()->json(
                [
                    "status" => 1,
                    "message" => "automobile supprimer avec succèss",
                ]);

            }else
            {
                return response()->json(
                    [
                        "status" => 0,
                        "message" => "aucune donnée trouvée"
                    ],
            404);

        }
    }
}
