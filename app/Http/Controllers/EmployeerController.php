<?php

namespace App\Http\Controllers;

use App\Employeer;
use Illuminate\Http\Request;
use Validator;
use App\EmployeerDetail;
use App\Certificate;
use App\EmployerCertificate;
use App\OtherCompanyCareers;
use App\MedicalCheckup;
use App\CemanBookNumber;
use App\Passport;
use App\AllInOne;
use App\Injury;
use App\Evaluation;

// use Illuminate\Support\Facades\DB;
use DB;
use Illuminate\Database\Eloquent\Builder;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
class EmployeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCrewEvoluation(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'date' => 'required',
            'score' => 'required',
            're_use' => 'required',
            'rate' => 'required',
            'detail' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }
        $evaluation = Evaluation::updateOrCreate(
            ['id' => $req->evaluation_id, 'user_id' => $req->employer_id],
            [
                'date' => $req->date,
                'score' => $req->score,
                're_use' => $req->re_use,
                'rate' => $req->rate,
                'detail' => $req->detail,
                'user_id' => $req->employer_id,
            ]
        );

        return response()->json(['message' => "Success!", 'evaluation' => $evaluation], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if($req->personId) {
            $require = 'required';
        } else {
            $require = 'required|unique:employeers,crew_code';
        }

        $validator = Validator::make($req->all(), [
            'crewcode' => $require,
            'name' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'pob' => 'required',
            'edulevel' => 'required',
            'ship'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $format = date("Y-m-d", strtotime($req->dob));
        $employeer = Employeer::updateOrCreate(
            ['id' => $req->personId, 'crew_code' => $req->crewcode],
            ['crew_code' => $req->crewcode, 'name' => $req->name, 'nationality' => $req->nationality, 'date_of_birth' => $format, 'place_of_birth' => $req->pob, 'education_level' => $req->edulevel, 'ship'=>$req->ship]
        );
        return response()->json(["message" => "success", "employeer" => $employeer], 200);
    }


    // Store  Form Two
    public function storeFormTwo(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'phone_number' => 'required',
            'cell_phone_number' => 'required',
            'drinking' => 'required',
            'smoking' => 'required',
            'rank' => 'required',
            'company' => 'required',
            'basic_salary' => 'required',
            'home_allowance' => 'required',
            'total_salary' => 'required',
            'fixed_pay' => 'required',
            'leave_pay' => 'required',
            'onbroad_pay' => 'required',
            'code' => 'required',
            'pants' => 'required',
            'shoe' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }
        $format = date("Y-m-d", strtotime($req->deperature_date));
        $employeer_detail = EmployeerDetail::updateOrCreate(
            ['id' => $req->employer_detail_id, 'employer_id' => $req->employerId],
            [
                'deperature_date' => $format,
                'basic_salary' => $req->basic_salary,
                'phone_number' => $req->phone_number,
                'cell_phone_number' => $req->cell_phone_number,
                'drinking' => $req->drinking,
                'smoking' => $req->smoking,
                'rank' => $req->rank,
                'company' => $req->company,
                'home_allowance' => $req->home_allowance,
                'total_salary' => $req->total_salary,
                'fixed_pay' => $req->fixed_pay,
                'leave_pay' => $req->leave_pay,
                'onbroad_pay' => $req->onbroad_pay,
                'code' => $req->code,
                'pants' => $req->pants,
                'shoe' => $req->shoe,
                'employer_id' => $req->employerId,
                'basicsalary_currency' => $req->basicsalary_currency,
                'onbroadpay_currency' => $req->onbroadpay_currency,
                'fixpay_currency' => $req->fixpay_currency,
                'leavepay_currency' => $req->leavepay_currency,
                'home_allowance_currency' => $req->home_allowance_currency,
                'total_salary_currency' => $req->total_salary_currency,
            ]
        );

        return response()->json(['message' => 'success', 'employer_detail' => $employeer_detail], 200);
    }


    // Save Certificate
    public function saveCertificate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'licine_number' => 'required',
            'remark' => 'required',
            'employer_id' => 'required',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $training_date = date("Y-m-d", strtotime($req->training_date));
        $expire_date = date("Y-m-d", strtotime($req->expire_date));
        $images = json_encode($req->image);
        $emp_certificate = EmployerCertificate::updateOrCreate(
            ['id' => $req->id, 'employer_id' => $req->employer_id],
            [
                'employer_id' => $req->employer_id,
                'certificate_id' => $req->certificate_name,
                'licine_number' => $req->licine_number,
                'training_date' => $training_date,
                'expire_date' => $expire_date,
                'image' => $images,
                'remark' => $req->remark
            ]
        );
        return response()->json(['message' => 'success', 'employerCertificate' => $emp_certificate], 200);
    }

    //Get Certificate
    public function getCertificate(Request $req)
    {
        $certificates = Certificate::all();
        return response()->json(['certificates' => $certificates], 200);
    }

    //getEmployerCertificate
    public function getEmployerCertificate(Request $req)
    {
        $query = EmployerCertificate::select(DB::Raw("employer_certificates.id as id, employer_certificates.licine_number as licine_number, DATE_FORMAT(employer_certificates.training_date,'%d-%m-%Y') as training_date, DATE_FORMAT(employer_certificates.expire_date,'%d-%m-%Y') as expire_date, employer_certificates.image as image, employer_certificates.remark as remark"), "certificate_id")
        ->with(['certificate'])
        ->where('employer_certificates.employer_id', '=', $req->employer_id);
        if(!empty($req->search)) {
            $search = $req->search;
            $query -> where('employer_certificates.licine_number', 'LIKE',"%{$search}%")
            -> orWhere('employer_certificates.training_date', 'LIKE',"%{$search}%")
            -> orWhere('employer_certificates.expire_date', 'LIKE',"%{$search}%")
            ->orWhere(function($query) use ($search){
                $query -> whereHas('certificate', function (Builder $query) use ($search) {
                    $query->where('certificates.title', 'LIKE',"%{$search}%");
                });
            });
        }

        $data = $query->orderBy('created_at', $req->dir)->paginate($req->length);
        return new DataTableCollectionResource($data);
    }

    //Delete Certificate
    public function deleteCertificate(Request $req)
    {
        EmployerCertificate::where('id', '=', $req->id)->where('employer_id', '=', $req->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function saveOtherCompanyCareers(Request $request){
        $validator = Validator::make($request->all(), [
            'rank' => 'required',
            'grt' => 'required|integer',
            'kw' => 'required|integer',
            'company_name' => 'required',
            'ship_name' => 'required',
            'boarding_date' => 'required',
            'leaving_date' => 'required',
            'area' => 'required',
            'company_remark' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $boarding_format = date("Y-m-d", strtotime($request->boarding_date));
        $leaving_format = date("Y-m-d", strtotime($request->leaving_date));
        $companyCareers = OtherCompanyCareers::updateOrCreate(
            ['id' => $request->company_career_id],
            ['user_id' => $request->user_id,
            'rank' => $request->rank,
            'grt' => $request->grt,
            'kw' => $request->kw,
            'company_name' => $request->company_name,
            'ship_name' => $request->ship_name,
            'boarding_date' => $boarding_format,
            'leaving_date' => $leaving_format,
            'area' => $request->area,
            'remark' => $request->company_remark]
        );
        return response()->json(["message" => "success", "companyCareers" => $companyCareers], 200);
    }

    public function getAllCompanyCareersByEmployerId(Request $request){
        $companyCareers = OtherCompanyCareers::where('user_id', '=', $request->user_id)->paginate(2);
        return new DataTableCollectionResource($companyCareers);
    }

    public function deleteCompanyCareer(Request $request){
        OtherCompanyCareers::where('id', '=', $request->id)->where('user_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }

    // saveMedicalCheckup
    public function saveMedicalCheckup(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'med_date' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'checst' => 'required',
            'tooth' => 'required',
            'tooth_state' => 'required',
            'color_blindness' => 'required',
            'blood_type' => 'required',
            'xray' => 'required',
            'sight_right' => 'required',
            'sight_left' => 'required',
            'hearing_right' => 'required',
            'hearing_left' => 'required',
            'hospital' => 'required',
            'decision' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }
        $images = json_encode($req->images);
        $date = date("Y-m-d", strtotime($req->med_date));
        $medical_checkup = MedicalCheckup::updateOrCreate(
            ['id' => $req->medicalCheckupId, 'employer_id' => $req->employerId],
            [
                'employer_id' => $req->employerId,
                'images' => $images,
                'med_date' => $date,
                'weight' => $req->weight,
                'height' => $req->height,
                'tooth' => $req->tooth,
                'tooth_state' => $req->tooth_state,
                'color_blindness' => $req->color_blindness,
                'blood_type' => $req->blood_type,
                'xray' => $req->xray,
                'checst' => $req->checst,
                'sight_right' => $req->sight_right,
                'sight_left' => $req->sight_left,
                'hearing_left' => $req->hearing_left,
                'hearing_right' => $req->hearing_right,
                'hospital' => $req->hospital,
                'decision' => $req->decision,
            ]
        );
        return response()->json(['message' => 'success', 'mde' => $medical_checkup], 200);
    }

    //CemanBookNumber
    public function saveCemanBook(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'cbn' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $images = json_encode($req->cbn_images);

        $cbn = CemanBookNumber::updateOrCreate(
            ['id' => $req->cbn_id, 'employer_id' => $req->employer_id],
            ['employer_id' => $req->employer_id, 'images' => $images, 'cbn' => $req->cbn]
        );
        return response()->json(['message' => 'success', 'cbn' => $cbn], 200);
    }

    //Injury
    public function saveInjury(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'illness' => 'required',
            'medical_name' => 'required',
            'hospital_name' => 'required',
            'start_date' => 'required',
            'recovery_date' => 'required',
            'hospital_type' => 'required',
            'expenses_won' => 'required',
            'expenses_ex' => 'required',
            // 'remark' => 'required',
            'employer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $injury = Injury::updateOrCreate(
            ['id' => $req->injury_id, 'user_id' => $req->employer_id],
            [
                'user_id' => $req->employer_id,
                'illness' => $req->illness,
                'medical_name' => $req->medical_name,
                'hospital_name' => $req->hospital_name,
                'start_date' => $req->start_date,
                'recovery_date' => $req->recovery_date,
                'hospital_type' => $req->hospital_type,
                'expenses_won' => $req->expenses_won,
                'expenses_ex' => $req->expenses_ex,
                'remark' => $req->remark,
            ]
        );
        return response()->json(['message' => 'success', 'injury' => $injury], 200);
    }

     //All-in-One
     public function saveAllInOne(Request $req)
     {
         // dd($req->all());
         $validator = Validator::make($req->all(), [
             'coc' => 'required|integer',
             'gmbss' => 'required|integer'
         ]);
         if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()], 400);
         }

         $images = json_encode($req->all_images);

         $allInOne = AllInOne::updateOrCreate(
             ['id' => $req->all_in_one_id, 'employer_id' => $req->employer_id],
             ['employer_id' => $req->employer_id, 'images' => $images, 'coc' => $req->coc, 'gmbss' => $req->gmbss]
         );
         return response()->json(['message' => 'success', 'all_in_one' => $allInOne], 200);
     }





}
