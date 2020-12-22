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
Route::post("get-users", 'HomeController@getusers');
Route::post("reset-password", 'HomeController@resetPassword');
Route::post("delete-user", 'HomeController@deleteUser');
Route::post("create-user", 'HomeController@creatUser');
Route::post("image-upload", "HomeController@imageUpload");
Route::post("image-upload-form-seven", "HomeController@imageUpload");
Route::post("image-upload-edit", "HomeController@imageUploadEdit");
Route::post("image-delete", "HomeController@imageDelte");

//disease
Route::post("save-disease", "DiseaseController@store");
Route::post("get-all-disease", "DiseaseController@getAllDisease");
Route::post("delete-disease", "DiseaseController@deleteDisease");

//accident
Route::post("save-accident", "AccidentController@store");
Route::post("get-all-accident", "AccidentController@getAllAccident");
Route::post("delete-accident", "AccidentController@deleteAccident");

Route::post("save-form-one", "EmployeerController@store");
Route::post("save-form-two", "EmployeerController@storeFormTwo");
Route::post("save-certificate", "EmployeerController@saveCertificate");
Route::post("get-certificate", "EmployeerController@getCertificate");
Route::post("get-employer-certificate", "EmployeerController@getEmployerCertificate");
Route::post("delete-certificate", "EmployeerController@deleteCertificate");

Route::post("save-family-member", "FamilyMemberController@store");
Route::post("get_all_family_members_by_employer", "FamilyMemberController@getAllFaimilyMemberByEmployerId");

Route::post("save-other-company-careers","EmployeerController@saveOtherCompanyCareers");
Route::post("get_all_company_careers_by_employerId", "EmployeerController@getAllCompanyCareersByEmployerId");

Route::post("delete-company-career", "EmployeerController@deleteCompanyCareer");
Route::post("delete-family-member", "FamilyMemberController@deleteFamilyMember");

Route::post('save-medical-checkup', 'EmployeerController@saveMedicalCheckup');
Route::post('save-cbn', 'EmployeerController@saveCemanBook');
Route::post('save-passport', 'EmployeerController@savePassport');
Route::post('save-all-in-one', 'EmployeerController@saveAllInOne');

//Certificate
Route::post('get-all-certificate', 'CertificateController@getAllCertificate');
Route::post('certificate-delete', 'CertificateController@delete');

//company
Route::post('get-all-company', 'CompanyController@getAllCompany');
Route::post('company-delete', 'CompanyController@delete');

//ship
Route::post('get-all-ship', 'ShipController@getAllShip');
Route::post('ship-delete', 'ShipController@delete');

//Employer Detail
Route::post('get-person-detail', 'DetailController@personDetail');
Route::post('get-familymember', 'DetailController@familyMember');
Route::post('get-employer-certificate-detail', 'DetailController@getEmployerCertificate');
Route::post('get-meidicalcheckup', 'DetailController@getMeidicalcheckup');
Route::post('get-other-company', 'DetailController@getOtherCompany');
Route::post('get-seaman-book', 'DetailController@getSeamanBook');
Route::post('get-passport', 'DetailController@getPassport');
Route::post('get-allinone', 'DetailController@getAllinOne');
Route::post('get-additional-info', 'DetailController@getAdditinalInfo');
Route::post('get-all-disease-detail', 'DetailController@getAllDisease');
Route::post('get-all-accident-detail', 'DetailController@getAllAccident');


