<?php

use App\Http\Controllers\MessageThreadController;
use App\Http\Controllers\SocialiteController;
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






//Route::apiResource('/messageThread', MessageThreadController::class);
//Route::post('/messageThread/{messageThread}/reply/',[MessageThreadController::class,'reply']);        
Route::get('/resumes',function () {
   return response()->download(storage_path('app/resumes/quera_resume.pdf'));

});
