<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;
use App\EmployeerDetail;
use App\FamilyMember;
use App\EmployerCertificate;
use App\Certificate;
use App\MedicalCheckup;
use App\OtherCompanyCareers;
use App\CemanBookNumber;
use App\Passport;
use App\AllInOne;
use DB;
class DetailController extends Controller
{
    public function personDetail(Request $req)
    {
    	$person_detail = Employeer::find($req->id);
    	return response()->json(['person_detail' => $person_detail], 200);
    }

    public function familyMember(Request $req)
    {
    	$family_members = FamilyMember::select(DB::Raw("family_members.*, DATE_FORMAT(family_members.dob, '%d-%m-%Y') as date_of_birth"))->where('user_id', '=', $req->user_id)->get();
    	return response()->json(['family_members' => $family_members], 200);
    }

    public function getEmployerCertificate(Request $req)
    {
    	$certificates = EmployerCertificate::leftJoin('certificates', 'employer_certificates.certificate_id', '=', 'certificates.id')
    					->select(DB::Raw("employer_certificates.*, certificates.title as name, DATE_FORMAT(employer_certificates.training_date, '%d-%m-%Y') as training_date, DATE_FORMAT(employer_certificates.expire_date, '%d-%m-%Y') as expire_date"))
    					->where("employer_id", "=", $req->employer_id)
    					->get();
    	return response()->json(['certificates' => $certificates], 200);
    }

    public function getMeidicalcheckup(Request $req)
    {
    	$medicalcheckup = MedicalCheckup::select(DB::Raw("medical_checkups.*, DATE_FORMAT(medical_checkups.med_date, '%d-%m-%Y') as mdDate"))->where('employer_id', '=', $req->employer_id)->first();
    	return response()->json(['medicalcheckup' => $medicalcheckup], 200);
    }

    public function getOtherCompany(Request $req)
    {
        $othercompanies = OtherCompanyCareers::select(DB::Raw("other_company_careers.*, DATE_FORMAT(other_company_careers.boarding_date, '%d-%m-%Y') as boarding_date, DATE_FORMAT(other_company_careers.leaving_date, '%d-%m-%Y') as leaving_date"))->where('user_id', '=', $req->employer_id)->get();
        return response()->json(['othercompanies' => $othercompanies], 200);
    }

    public function getSeamanBook(Request $req)
    {
        $seamanbook = CemanBookNumber::where('employer_id', '=', $req->employer_id)->first();
        return response()->json(['seamanbook' => $seamanbook], 200);
    }

    public function getAdditinalInfo(Request $req)
    {
        $additionalInfo = EmployeerDetail::select(DB::Raw("employeer_details.*"))->where('employer_id', '=', $req->employer_id)->first();
        return response()->json(['additionalinfo' => $additionalInfo], 200);
    }

    public function getAllImage(Request $req)
    {
        $getimages = EmployerCertificate::with('certificate')->where('employer_id', '=', $req->employer_id)->get();
        return response()->json(['message' => 'success', 'images' => $getimages]);
    }
}
