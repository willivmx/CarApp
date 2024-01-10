<?php

use App\Http\Controllers\API\abonnés;
use App\Http\Controllers\API\abonnésController;
use App\Http\Controllers\API\automobilesController;
use App\Http\Controllers\API\depot_automobile;
use App\Http\Controllers\API\depot_automobileContoller;
use App\Http\Controllers\API\depot_automobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});




//api
// route pour automobiles
route::get("automobiles",[automobilesController::class, "liste_automobiles"]);
route::get("automobiles/{id}",[automobilesController::class, "get_automobiles"]);
route::post("creer-automobiles",[automobilesController::class, "create_automobiles"]);
route::PUT("update-automobiles/{id}",[automobilesController::class, "update_automobiles"]);
route::delete("delete-automobiles/{id}",[automobilesController::class, "delete_automobiles"]);
