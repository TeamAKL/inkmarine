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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Route::get('/employer/create', function() {
//     return view('employers.create');
// })->middleware("auth");

Route::get('/employer/create', function() {
    return view('employers.create');
});

//for certificates
Route::get('/certificate/create', 'CertificateController@create');
Route::post('/certificate', 'CertificateController@store');
Route::get('/certificate','CertificateController@index');
Route::get('/certificate/edit/{id}','CertificateController@edit');
Route::put('/certificate/update','CertificateController@update');
Route::get('/certificate/del/{id}','CertificateController@delete');
