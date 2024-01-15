<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car as CarsModel;

class carsController extends Controller
{
    public function list_cars(){
        {
            $cars = CarsModel::get();
            return response()->json([
                "message" => "liste des véhicules",
                "data" => $cars
            ], 200);
        }
    }
    public function get_car($id){
        return "get a car";
    }
    public function create_car(){
        return "create a car";
    }
    public function update_car($id){
        return "update a car";
    }
    public function delete_car($id){
        return "delete a car";
    }
}
