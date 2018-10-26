<?php
use Illuminate\Support\Facades\Route;
// use Symfony\Component\Routing\Annotation\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::prefix('')
//    ->namespace('api')
//    ->group(function (){
//        Route::get('news', 'NewsController@index')->name('news.index');
//
//    });
Route::get('/news', 'NewsController@index')->name('news');
require_once 'api.php';
require_once 'backend.php';

Route::get('/event/create', 'EventController@create')->name('event.create');
Route::post('/event/store', 'EventController@store')->name('event.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


