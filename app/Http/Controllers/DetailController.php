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
use App\Disease;
use App\Accident;
use App\Injury;
use App\Evaluation;
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

    public function getPassport(Request $req)
    {
        $passports = Passport::where('employer_id', '=', $req->employer_id)->first();
        return response()->json(['passports' => $passports], 200);
    }

    public function getAllinOne(Request $req)
    {
        $allinone = AllInOne::where('employer_id', '=', $req->employer_id)->first();
        return response()->json(['allinone' => $allinone], 200);
    }

    public function getAdditinalInfo(Request $req)
    {
        $additionalInfo = EmployeerDetail::select(DB::Raw("employeer_details.*"))->where('employer_id', '=', $req->employer_id)->first();
        return response()->json(['additionalinfo' => $additionalInfo], 200);
    }
    public function getAllDisease(Request $req)
    {
        $diseases = Disease::select(DB::Raw("diseases.*, DATE_FORMAT(diseases.start_date, '%d-%m-%Y') as start_date, DATE_FORMAT(diseases.end_date, '%d-%m-%Y') as end_date"))->where('employer_id', '=', $req->employer_id)->get();
        return response()->json(['diseases' => $diseases], 200);
    }
    public function getAllAccident(Request $req)
    {
        $accidents = Accident::select(DB::Raw("accidents.*, DATE_FORMAT(accidents.date, '%d-%m-%Y') as date"))->where('employer_id', '=', $req->employer_id)->get();
        return response()->json(['accidents' => $accidents], 200);
    }
    public function getAllInjury(Request $req)
    {
        $injuries = Injury::select(DB::Raw("injuries.*"))->where('user_id', '=', $req->employer_id)->get();
        return response()->json(['injuries' => $injuries], 200);
    }
    public function getAllEvaluation(Request $req)
    {
        $evaluations = Evaluation::select(DB::Raw("evaluations.*"))->where('user_id', '=', $req->employer_id)->get();
        return response()->json(['evaluations' => $evaluations], 200);
    }
}
