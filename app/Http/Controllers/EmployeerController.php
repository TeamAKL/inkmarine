<?php

namespace App\Http\Controllers;

use App\Employeer;
use Illuminate\Http\Request;
use Validator;

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
            'edulevel' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $format = date("Y-m-d", strtotime($req->dob));
        $employeer = Employeer::updateOrCreate(
            ['id' => $req->personId, 'crew_code' => $req->crewcode],
            ['crew_code' => $req->crewcode, 'name' => $req->name, 'nationality' => $req->nationality, 'date_of_birth' => $format, 'place_of_birth' => $req->pob, 'education_level' => $req->edulevel]
        );
        return response()->json(["message" => "success", "employeer" => $employeer], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employeer  $employeer
     * @return \Illuminate\Http\Response
     */
    public function show(Employeer $employeer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employeer  $employeer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employeer $employeer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employeer  $employeer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employeer $employeer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employeer  $employeer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employeer $employeer)
    {
        //
    }


    // Store  Form Two
    public function storeFormTwo(Request $req)
    {
        // $validator = Validator::make($req->all(), [
        //     'phone_number' => 'required',
        //     'cell_phone_number' => 'required',
        //     'drinking' => 'required',
        //     'smoking' => 'required',
        //     'rank' => 'required',
        //     'company' => 'required',
        //     'basic_salary' => 'required',
        //     'home_allowance' => 'required',
        //     'total_salary' => 'required',
        //     'fixed_pay' => 'required',
        //     'leave_pay' => 'required',
        //     'onbroad_pay' => 'required',
        //     'code' => 'required',
        //     'pan' => 'required',
        //     'shoe' => 'required'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()], 400);
        // }

        return response()->json(['message' => 'success'], 200);
    }
}
