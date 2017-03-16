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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('model/{model}/all', 'RestfulController@all');
Route::post('model/{model}/filter', 'RestfulController@filter');
Route::put('model/{model}/create', 'RestfulController@create');
Route::get('model/{model}/{id}', 'RestfulController@find');
Route::patch('model/{model}/{id}/update', 'RestfulController@update');
Route::delete('model/{model}/{id}/delete', 'RestfulController@delete');

Route::bind('model', function($model){
    $class = 'App\Models\\' . ucfirst($model);
    if(class_exists($class)){
        return new $class;
    }
    throw new \Illuminate\Database\Eloquent\ModelNotFoundException($class);
});