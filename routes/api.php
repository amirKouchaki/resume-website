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
Route::post('send-sms',function (Request $request){
    try{

        $sms = Melipayamak\Laravel\Facade::sms();
        $to = '09114366636';
        $from = '50004001366636';
        $text = 'تست وب سرویس ملی پیامک از امیر';
        $response = $sms->send($to,$from,$text);
        $json = json_decode($response);
        return $json;
        return $json->Value; //RecId or Error Number
    }catch(Exception $e){
        dd( $e->getMessage());
    }
});

Route::post('/hello',function (Request $request){
   return "hello from me";
});

