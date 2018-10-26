<?php
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
// Route::prefix('api')
//      ->namespace('Api')
//      ->group(function (){
    
//          Route::get('/news', 'NewsController@index')->name('news');
         
//      });

     Route::resource('/events', 'EventController');