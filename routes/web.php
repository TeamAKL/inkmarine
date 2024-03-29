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
// Route::match(['get', 'post'], 'register', function () {
//     return abort(403, 'Forbidden');
// })->name('register');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Route::get('/employer/create', function() {
//     return view('employers.create');
// })->middleware("auth");

Route::get('/employer/create', function() {
    return view('employers.create');
})->middleware('auth');

//for certificates
Route::post('/certificate', 'CertificateController@store');
Route::get('/certificate','CertificateController@index');

//for company
Route::post('/company', 'CompanyController@store');
Route::get('/company','CompanyController@index');

// Route::get('/ship/create', 'ShipController@create');
Route::post('/ship', 'ShipController@store');
Route::get('/ship','ShipController@index');

Route::get('detail/{id}', function() {
	return view('detail');
})->middleware('auth');

Route::get('users', function() {
    return view('layouts.user');
})->middleware(['auth', 'isadmin']);
