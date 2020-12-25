<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disease;
use Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class DiseaseController extends Controller
{
    public function store(Request $request)
    {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
        'start_date' => 'required',
        'end_date' => 'required',
        'illness' => 'required',
        'medicine' => 'required',
        'other_medicine' => 'required',
        'remark' => 'required'
    ]);
    if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()], 400);
    }

    $start_date = date("Y-m-d", strtotime($request->start_date));
    $end_date = date("Y-m-d", strtotime($request->end_date));
    $disease = Disease::updateOrCreate(
        ['id' => $request->diseaseId],
        [
            'employer_id' => $request->employerId,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'illness' => $request->illness,
            'medicine' => $request->medicine,
            'other_medicine' => $request->other_medicine,
            'remark' => $request->remark 
        ]
    );
    return response()->json(["message" => "success", "disease" => $disease], 200);
    }

    public function getAllDisease(Request $request){
        $disease = Disease::where('employer_id', '=', $request->user_id)->paginate(2);
         return new DataTableCollectionResource($disease);
    }

    public function deleteDisease(Request $request){
        Disease::where('id', '=', $request->id)->where('employer_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }
}



