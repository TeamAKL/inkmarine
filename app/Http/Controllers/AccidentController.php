<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accident;
use Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class AccidentController extends Controller
{
    public function store(Request $request)
    {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
        'ship_name' => 'required',
        'rank' => 'required',
        'date' => 'required',
        'type' => 'required',
        'reason' => 'required',
        'cost' => 'required',
        'currency'=>'required',
        're_use' => 'required',
        'etc' => 'required',
        'remark' => 'required'
    ]);
    if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()], 400);
    }

    $date = date("Y-m-d", strtotime($request->date));
    $accident = Accident::updateOrCreate(
        ['id' => $request->accidentId],
        [
            'employer_id' => $request->employerId,
            'ship_name' => $request->ship_name,
            'rank' => $request->rank,
            'date' => $date,
            'type' => $request->type,
            'reason' => $request->reason,
            'cost' => $request->cost,
            'currency'=>$request->currency,
            're_use'=>$request->re_use,
            'etc'=>$request->etc,
            'remark'=>$request->remark 
        ]
    );
    return response()->json(["message" => "success", "accident" => $accident], 200);
    }

    public function getAllAccident(Request $request){
        $accident = Accident::where('employer_id', '=', $request->user_id)->paginate(2);
         return new DataTableCollectionResource($accident);
    }

    public function deleteAccident(Request $request){
        Accident::where('id', '=', $request->id)->where('employer_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
