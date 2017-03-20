<?php

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



Route::group(["middleware"=>["web"]], function(){

    Route::get('auth/login','Auth\LoginController@showLoginForm');
    Route::post('auth/login','Auth\AuthController@postLogin');
    Route::post('auth/logout','Auth\AuthController@postLogout');

    Route::get('auth/register','Auth\RegisterController@showRegistrationForm');
    Route::post('auth/register','Auth\AuthController@postRegister');

    Route::get('/', "SehifeController@getIndex");

    Route::get('/about', "SehifeController@getAbout");

    Route::get("/contact" , function(){
      return view("pages/contact");
    });

    Route::resource("posts" , "PostController");
	  Route::get("blog/{slug}" , ["as"=>"blog.single", "uses"=>"BlogController@getSingle"])
        ->where("slug","[\w\d\-\_]+");
    Route::get("blog" , ["uses"=>"BlogController@getIndex" , "as"=>"blog.index"]);

});
