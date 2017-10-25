<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Page Not Found"omething great!
|
*/

Route::get('/', function () {

    $carousels = DB::table('carousel')->get();
    return view('welcome', compact('carousels'));

})->middleware('guest'); 


Auth::routes();

Route::get('/home', 'HomeController@services');
Route::get('/servicess', 'HomeController@services');
Route::get('/forums', 'HomeController@forums');
Route::get('/blogs', 'HomeController@blogs');
Route::get('/aboutus', 'HomeController@aboutus');

Route::get('/getPictures', 'HomeController@getPictures');
Route::get('/addToCart', 'HomeController@addToCart');


// Facebook

Route::get('login/facebook', 'Auth\LoginController@facebookRedirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@facebookHandleProviderCallback');

// Google

Route::get('login/google', 'Auth\LoginController@googleRedirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@googleHandleProviderCallback');



