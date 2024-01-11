<?php

use App\Http\Controllers\API\abonnés;
use App\Http\Controllers\API\abonnésController;
use App\Http\Controllers\API\automobilesController;
use App\Http\Controllers\API\depot_automobile;
use App\Http\Controllers\API\depot_automobileContoller;
use App\Http\Controllers\API\depot_automobileController;
use App\Http\Controllers\API\locationsController;
use App\Http\Controllers\API\permissionsController;
use App\Http\Controllers\API\rolesController;
use App\Http\Controllers\API\utilisateursController;
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
route::get("automobile/{id}",[automobilesController::class, "get_automobile"]);
route::post("creer-automobile",[automobilesController::class, "create_automobile"]);
route::put("update-automobile/{id}",[automobilesController::class, "update_automobile"]);
route::delete("delete-automobile/{id}",[automobilesController::class, "delete_automobile"]);

// Routes pour locations
Route::get("locations", [locationsController::class, "list_locations"]);
Route::get("location/{id}", [locationsController::class, "get_location"]);
Route::post("creer-location", [locationsController::class, "create_location"]);
Route::put("update-location/{id}", [locationsController::class, "update_location"]);
Route::delete("delete-location/{id}", [locationsController::class, "delete_location"]);

// Routes pour permissions
Route::get("permissions", [permissionsController::class, "list_permissions"]);
Route::get("permission/{id}", [permissionsController::class, "get_permissions"]);
Route::post("creer-permission", [permissionsController::class, "create_permissions"]);
Route::put("update-permission/{id}", [permissionsController::class, "update_permissions"]);
Route::delete("delete-permission/{id}", [permissionsController::class, "delete_permissions"]);

// Routes pour roles
Route::get("roles", [rolesController::class, "list_roles"]);
Route::get("role/{id}", [rolesController::class, "get_roles"]);
Route::post("creer-role", [rolesController::class, "create_roles"]);
Route::put("update-role/{id}", [rolesController::class, "update_roles"]);
Route::delete("delete-role/{id}", [rolesController::class, "delete_roles"]);

// Routes pour utilisateurs
Route::get("utilisateurs", [utilisateursController::class, "list_utilisateurs"])->middleware('auth:api', 'admin');
Route::get("utilisateur/{id}", [utilisateursController::class, "get_utilisateur"])->middleware('auth:api');
Route::post("creer-utilisateur", [utilisateursController::class, "create_utilisateur"]);
Route::put("update-utilisateur/{id}", [utilisateursController::class, "update_utilisateur"])->middleware('auth:api');
Route::delete("delete-utilisateur/{id}", [utilisateursController::class, "delete_utilisateur"])->middleware('auth:api', 'admin');
