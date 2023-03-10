<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/hello',function (Request $request){
   return "hello from me";
});


Route::apiResource('/messageThread',\App\Http\Controllers\MessageThreadController::class);
Route::post('/messageThread/{messageThread}/reply/',[\App\Http\Controllers\MessageThreadController::class,'reply']);
