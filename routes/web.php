<?php

use Illuminate\Support\Facades\Route;

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
    return view('landing.home');
});


Route::get('/home', function () {
    return redirect('/app');
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['prefix' => 'app'], function()
{
    Route::get('/', 'AppController@index')->name('indexApp');
    Route::get('/courses/{id}', 'AppController@view')->name('viewApp');
    Route::get('/view/{id}', 'AppController@video')->name('viewCourseApp');
    Route::post('/view', 'AppController@videoSave')->name('viewSaveApp');
    Route::get('/profile', 'AppController@profile')->name('profileApp');
    Route::post('/profile', 'AppController@profileUpdated')->name('profileUpdated');
   
});