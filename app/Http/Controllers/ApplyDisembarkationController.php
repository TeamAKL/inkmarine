<?php

namespace App\Http\Controllers;

use App\ApplyDisembarkation;
use Illuminate\Http\Request;
use DB;

class ApplyDisembarkationController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
//        $validator = Validator::make($request->all(), [
//            'member_name' => 'required',
//            'member_relation' => 'required',
//            'member_phone_number' => 'required',
//            'member_dob' => 'required',
//            'member_remark' => 'required'
//        ]);
//        if ($validator->fails()) {
//            return response()->json(['error'=>$validator->errors()], 400);
//        }

        $apply = ApplyDisembarkation::updateOrCreate(
            ['id' => $request->apply_disembarkation_id],
            ['user_id' => $request->user_id, 'content' => $request->content, 'successor' => $request->successor, 'remark' => $request->disembarkation_remark]
        );
        return response()->json(["message" => "success", "applyDisembarkation" => $apply], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ApplyDisembarkation  $applyDisembarkation
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyDisembarkation $applyDisembarkation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApplyDisembarkation  $applyDisembarkation
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplyDisembarkation $applyDisembarkation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApplyDisembarkation  $applyDisembarkation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplyDisembarkation $applyDisembarkation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApplyDisembarkation  $applyDisembarkation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplyDisembarkation $applyDisembarkation)
    {
        //
    }


    public function getApplyDisembarkation(Request $req)
    {
        $applyDisembarkation = ApplyDisembarkation::select(DB::Raw("apply_disembarkations.*"))->where('user_id', '=', $req->employer_id)->get();
        return response()->json(['applyDisembarkations' => $applyDisembarkation], 200);
    }

    public function deleteApplyDisem(Request $request){
        ApplyDisembarkation::where('id', '=', $request->id)->where('user_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }


}
