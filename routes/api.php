<?php

use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
*/

//->middleware(['auth:sanctum']); para ruta por ruta
Route::middleware(['auth:sanctum'])->group(function() { //Grupo de rutas

    Route::apiResource('v1/products', ProductController::class);

    Route::post('/v1/logout', [App\Http\Controllers\api\v1\AuthController::class, 'logout'])->name('api.logout');
});



//Públicas
Route::post('/v1/login', [App\Http\Controllers\api\v1\AuthController::class, 'login'])->name('api.login');
