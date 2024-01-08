<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\abonnés;
use Illuminate\Http\Request;

class abonnésController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listabonnés()
    {
        $abonnés = abonnés::get();
        return response()->json([
            "status" => 1,
            "message" => "liste des abonnés",
            "date" => $abonnés
        ], 200);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //return $request;
        //validation

        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "email" => "required|email|unique:abonnés",
            "numéro" => "required"
            ]);


            //creation d'un abonné
            $abonné = new abonnés();
            $abonné->nom = $request->nom;
            $abonné->prenom = $request->prenom;
            $abonné->email = $request->email;
            $abonné->numéro = $request->numéro;
            $abonné->save();


            //renvoie de réponse
            return response()->json(
                [
                    "status" => 1,
                    "message" => "abonné enregistré avec succèss"
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
    public function getabonné(string $id)
    {
            //verifier si un abonné a cet ID

            $abonné = abonnés::where("id",$id)->exists();
            if($abonné)
            {
                $info = abonnés::find($id);

                return response()->json(
                    [
                        "status" => 1,
                        "message" => "abonné trouvé",
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
    public function update(Request $request, string $id)
    {
        //vérifie si l'abonnés existe d'abord
        $abonné = abonnés::where("id",$id)->exists();
        if($abonné)
            {
                $info = abonnés::find($id);
                $info->nom = $request->nom;
                $info->prenom = $request->prenom;
                $info->email = $request->email;
                $info->numéro = $request->numéro;
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
    public function delete(string $id)
    {
        $abonné = abonnés::where("id",$id)->exists();
            if($abonné)
            {
                $abonné = abonnés::find($id);

                $abonné -> delete();

                return response()->json(
                    [
                        "status" => 1,
                        "message" => "abonné supprimer avec succèss",
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
