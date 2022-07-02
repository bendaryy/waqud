<?php

use App\Http\Controllers\api\petrolController;
use App\Http\Controllers\api\SubCarController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('logout/{tokenId}', function (Request $request, $tokenId) {
    $request->user()->tokens()->where('id', $tokenId)->delete();

});
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('petrol', petrolController::class);
Route::apiResource('subcar', SubCarController::class);
