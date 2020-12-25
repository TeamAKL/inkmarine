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

//Injury
Route::post('save-injury', 'EmployeerController@saveInjury');
Route::post('save-all-in-one', 'EmployeerController@saveAllInOne');

//Certificate
Route::post('get-all-certificate', 'CertificateController@getAllCertificate');
Route::post('certificate-delete', 'CertificateController@delete');

//company
Route::post('get-all-company', 'CompanyController@getAllCompany');
Route::post('company-delete', 'CompanyController@delete');

//Crew Evaluation
Route::post('save-crew-evoluation', 'EmployeerController@saveCrewEvoluation');

//DMA
Route::post('save-dma', 'EmployeerController@saveDma');

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

Route::post("save-appointment-info", "AppointmentInfoController@store");
Route::post("save-apply-disembarkation", "ApplyDisembarkationController@store");
Route::post('get-appointment-info', 'AppointmentInfoController@getAppointmentInfo');
Route::post('get-apply-disembarkation', 'ApplyDisembarkationController@getApplyDisembarkation');
Route::post("delete-apply-disem", "ApplyDisembarkationController@deleteApplyDisem");
Route::post("delete-appointment-info", "AppointmentInfoController@deleteAppointmentInfo");