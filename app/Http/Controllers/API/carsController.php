<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car as CarsModel;
use Illuminate\Http\Request;

class carsController extends Controller
{
    public function list_cars(){
        {
            $cars = CarsModel::get();
            return response()->json($cars, 200);
        }
    }
    public function get_car($id){
            $car = CarsModel::find($id);
            if($car)
                return response()->json($car, 200);
            else
                return response()->json([],404);
    }

    public function create_car(Request $request){
        $request->validate([
            "brand" => "required",
            "model" => "required",
            "year" => "required",
            "color" => "required",
            "plate_number" => "required",
            "fuel_type" => "required",
            "mileage" => "required",
            "status" => "required"]);

        $car = new CarsModel();
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->color = $request->color;
        $car->plate_number = $request->plate_number;
        $car->fuel_type = $request->fuel_type;
        $car->mileage = $request->mileage;
        $car->status = $request->status;
        $car->save();

        return response()->json([
            "status" => 1,
            "message" => "Véhicule enregistré..."
        ]);
    }

    public function update_car(Request $request, string $id){
        $car = CarsModel::find($id);
        if($car){
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->year = $request->year;
            $car->color = $request->color;
            $car->plate_number = $request->plate_number;
            $car->fuel_type = $request->fuel_type;
            $car->mileage = $request->mileage;
            $car->status = $request->status;
            $car->save();
            return response()->json([
                "status" => 1,
                "message" => "Véhicule modifié..."
            ]);
        }else{
            return response()->json([],404);
        }
    }

    public function delete_car($id){
        $car = CarsModel::find($id);
        if($car){
            $car->delete();
            return response()->json([
                "status" => 1,
                "message" => "Véhicule supprimé..."
            ]);
        }else{
            return response()->json([],404);
        }
    }
}
