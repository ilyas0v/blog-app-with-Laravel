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

    Route::get('auth/login',['as'=>'login' , 'uses'=>'Auth\LoginController@showLoginForm']);
    Route::post('auth/login','Auth\LoginController@login');
    Route::get('auth/logout',['as'=>'logout' , 'uses' => 'Auth\LoginController@logout']);

    Route::get('auth/register',['as'=>'register' , 'uses'=>'Auth\RegisterController@showRegistrationForm']);
    Route::post('auth/register','Auth\RegisterController@register');

    Route::get('/', "SehifeController@getIndex");

    Route::get('/about', "SehifeController@getAbout");

    Route::get("/contact" , function(){
      return view("pages/contact");
    });

    Route::post('contact' , 'SehifeController@postContact');
    //Route::get('sendd', 'SehifeController@sendd');
    Route::resource('categories' , 'CategoryController' , ['except'=>['create']]);
    Route::resource('tags' , 'TagController' , ['except'=>['create']]);

    Route::resource("posts" , "PostController");
	  Route::get("blog/{slug}" , ["as"=>"blog.single", "uses"=>"BlogController@getSingle"])
        ->where("slug","[\w\d\-\_]+");
    Route::get("blog" , ["uses"=>"BlogController@getIndex" , "as"=>"blog.index"]);

});
