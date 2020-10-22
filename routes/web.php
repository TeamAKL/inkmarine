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
// Route::get('/certificate/create', 'CertificateController@create');
// Route::post('/certificate', 'CertificateController@store');
Route::get('/certificate','CertificateController@index');
// Route::get('/certificate/edit/{id}','CertificateController@edit');
// Route::put('/certificate/update','CertificateController@update');
// Route::get('/certificate/del/{id}','CertificateController@delete');

//for company
Route::get('/company/create', 'CompanyController@create');
Route::post('/company', 'CompanyController@store');
Route::get('/company','CompanyController@index');
Route::get('/company/edit/{id}','CompanyController@edit');
Route::put('/company/update','CompanyController@update');
Route::get('/company/del/{id}','CompanyController@delete');

//for ship

Route::get('/ship/create', 'ShipController@create');
Route::post('/ship', 'ShipController@store');
Route::get('/ship','ShipController@index');
Route::get('/ship/edit/{id}','ShipController@edit');
Route::put('/ship/update','ShipController@update');
Route::get('/ship/del/{id}','ShipController@delete');

Route::get('detail/{id}', function() {
	return view('detail');
});