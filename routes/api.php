<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//      return $request->user();
// });

//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post("get-all-user", 'HomeController@getalluser');
//});

Route::post("get-all-user", 'HomeController@getalluser');
Route::post("image-upload", "HomeController@imageUpload");
Route::post("image-upload-edit", "HomeController@imageUploadEdit");


Route::post("save-form-one", "EmployeerController@store");
Route::post("save-form-two", "EmployeerController@storeFormTwo");

Route::post("save-family-member", "FamilyMemberController@store");
Route::post("get_all_family_members_by_employer", "FamilyMemberController@getAllFaimilyMemberByEmployerId");




