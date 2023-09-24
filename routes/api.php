<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\apiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('allProducts',[apiController::class,'index']);
Route::post('save',[apiController::class,'store']);
Route::get('product/{id}',[apiController::class,'show']);
Route::post('product/{id}/edit',[apiController::class,'edit']);
Route::delete('product/{id}/delete',[apiController::class,'destroy']);