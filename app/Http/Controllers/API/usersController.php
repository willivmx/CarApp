<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\user as usersModel;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function list_users(){
        {
            $users = usersModel::get();
            return response()->json($users, 200);
        }
    }
    public function get_user($id){
        $user = usersModel::find($id);
        if($user)
            return response()->json($user, 200);
        else
            return response()->json([],404);
    }

    public function update_user(Request $request, string $id){
        $user = usersModel::find($id);
        if($user){
            $user->brand = $request->brand;
            $user->model = $request->model;
            $user->year = $request->year;
            $user->color = $request->color;
            $user->plate_number = $request->plate_number;
            $user->fuel_type = $request->fuel_type;
            $user->mileage = $request->mileage;
            $user->status = $request->status;
            $user->cover = $request->cover;
            $user->save();
            return response()->json([
                "status" => 1,
                "message" => "Utilisateur modifié..."
            ]);
        }else{
            return response()->json([],404);
        }
    }

    public function delete_user($id){
        $user = usersModel::find($id);
        if($user){
            $user->delete();
            return response()->json([
                "status" => 1,
                "message" => "Utilisateur supprimé..."
            ]);
        }else{
            return response()->json([],404);
        }
    }
}
