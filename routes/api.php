<?php


use App\Http\Controllers\API\carsController;
use App\Http\Controllers\API\locationsController;
use App\Http\Controllers\API\usersController;
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

Route::group(['prefix' => '/cars', 'as' => 'cars.'], function () {
    route::get("/",[carsController::class, "list_cars"]);
    route::get("/{id}",[carsController::class, "get_car"]);
    route::post("/",[carsController::class, "create_car"]);
    route::put("/{id}",[carsController::class, "update_car"]);
    route::delete("/{id}",[carsController::class, "delete_car"]);
});

// Routes pour locations
Route::group(['prefix' => '/loans', 'as' => 'loans.'], function () {
    route::get("/",[locationsController::class, "list_locations"]);
    route::get("/{id}",[locationsController::class, "get_location"]);
    route::post("/",[locationsController::class, "create_location"]);
    route::put("/{id}",[locationsController::class, "update_location"]);
    route::delete("/{id}",[locationsController::class, "delete_location"]);
});

// Routes pour userss
Route::group(['prefix' => '/users', 'as' => 'users.'], function () {
    Route::get("/", [usersController::class, "list_users"]);
    Route::get("/{id}", [usersController::class, "get_user"]);
    Route::put("/{id}", [usersController::class, "update_users"]);
    Route::delete("/{id}", [usersController::class, "delete_users"]);
});
