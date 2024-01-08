<?php

use App\Http\Controllers\API\abonnés;
use App\Http\Controllers\API\abonnésController;
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

route::get("abonnés", [abonnésController::class, "listabonnés"]);
route::get("abonné/{id}", [abonnésController::class, "getabonné"]);
route::post("creer-abonné", [abonnésController::class, "create"]);
route::put("update_abonné/{id}", [abonnésController::class, "update"]);
route::delete("delete_abonné/{id}", [abonnésController::class, "delete"]);

