<?php

namespace App\Http\Controllers;

use App\AppointmentInfo;
use Illuminate\Http\Request;
use DB;

class AppointmentInfoController extends Controller
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
//        $validator = Validator::make($request->all(), [
//            'division' => 'required',
//            'ship_name' => 'required',
//            'rank' => 'required',
//            'app_leaving_date' => 'required',
//            'app_boarding_date' => 'required',
//            'boarding_period' => 'required',
//            'place' => 'required',
//            'remark' => 'required'
//        ]);
//        if ($validator->fails()) {
//            return response()->json(['error'=>$validator->errors()], 400);
//        }

        $formatLeaving = date("Y-m-d", strtotime($request->app_leaving_date));
        $formatBoarding = date("Y-m-d", strtotime($request->app_boarding_date));

        $appointment = AppointmentInfo::updateOrCreate(
            ['id' => $request->appointment_info_id],
            ['user_id' => $request->user_id, 'division' => $request->division, 'ship_name' => $request->ship_name, 'rank' => $request->rank, 'boarding_date' => $formatBoarding, 'leaving_date' => $formatLeaving, 'boarding_period'=> $request->boarding_period, 'place' => $request->place, 'remark' => $request->remark]
        );
        return response()->json(["message" => "success", "appointmentInfo" => $appointment], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppointmentInfo  $appointmentInfo
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentInfo $appointmentInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppointmentInfo  $appointmentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentInfo $appointmentInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppointmentInfo  $appointmentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentInfo $appointmentInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppointmentInfo  $appointmentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentInfo $appointmentInfo)
    {
        //
    }

    public function getAppointmentInfo(Request $req)
    {
        $appointmentInfos = AppointmentInfo::select(DB::Raw("appointment_infos.*, DATE_FORMAT(appointment_infos.boarding_date, '%d-%m-%Y') as boarding_date, DATE_FORMAT(appointment_infos.leaving_date, '%d-%m-%Y') as leaving_date"))->where('user_id', '=', $req->employer_id)->get();
        return response()->json(['appointmentInfos' => $appointmentInfos], 200);
    }

    public function deleteAppointmentInfo(Request $request){
        AppointmentInfo::where('id', '=', $request->id)->where('user_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }


}
