<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location as LocationModel;

class locationsController extends Controller
{
    public function list_locations(){
        {
            $locations = LocationModel::get();
            return response()->json($locations, 200);
        }
    }
    public function get_location($id){
            $location = LocationModel::find($id);
            if($location)
                return response()->json($location, 200);
            else
                return response()->json([],404);
    }

    public function create_location(Request $request){
        $request->validate([
            "car_id" => "required",
            "user_id" => "required",
            "location_date" => "required",
            "return_date" => "required",
            "location_amount" => "required",
            "status" => "required",
            "comment" => "optional"
        ]);

        $location = new LocationModel();
        $location->car_id = $request->car_id;
        $location->user_id = $request->user_id;
        $location->location_date = $request->location_date;
        $location->return_date = $request->return_date;
        $location->location_amount = $request->location_amount;
        $location->status = $request->status;
        $location->comment = $request->comment;
        $location->save();

        return response()->json([
            "status" => 1,
            "message" => "Location enregistrée..."
        ]);
    }

    public function update_location(Request $request, string $id){
        $location = LocationModel::find($id);
        if($location){
            $location->car_id = $request->car_id;
            $location->user_id = $request->user_id;
            $location->location_date = $request->location_date;
            $location->return_date = $request->return_date;
            $location->location_amount = $request->location_amount;
            $location->status = $request->status;
            $location->comment = $request->comment;
            $location->save();
            return response()->json([
                "status" => 1,
                "message" => "Location modifiée..."
            ]);
        }
        else{
            return response()->json([
                "status" => 0,
                "message" => "Location non trouvée..."
            ]);
        }
    }

    public function delete_location(string $id)
    {
        $location = LocationModel::find($id);
        if ($location) {
            $location->delete();
            return response()->json([
                "status" => 1,
                "message" => "Location supprimée..."
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Location non trouvée..."
            ]);
        }
    }
}
