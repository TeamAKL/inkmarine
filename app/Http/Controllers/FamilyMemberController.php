<?php

namespace App\Http\Controllers;

use App\FamilyMember;
use Illuminate\Http\Request;
use Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class FamilyMemberController extends Controller
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
        $validator = Validator::make($request->all(), [
            'member_name' => 'required',
            'member_relation' => 'required',
            'member_phone_number' => 'required',
            'member_dob' => 'required',
            'member_remark' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $format = date("Y-m-d", strtotime($request->member_dob));
        $familyMember = FamilyMember::updateOrCreate(
            ['id' => $request->family_member_id],
            ['user_id' => $request->user_id, 'name' => $request->member_name, 'relationship' => $request->member_relation, 'phone_number' => $request->member_phone_number, 'dob' => $format, 'remark' => $request->member_remark]
        );
        return response()->json(["message" => "success", "familyMember" => $familyMember], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FamilyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyMember $familyMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FamilyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyMember $familyMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FamilyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyMember $familyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FamilyMember  $familyMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyMember $familyMember)
    {
        //
    }

    public function getAllFaimilyMemberByEmployerId(Request $request){
        $familyMembers = FamilyMember::where('user_id', '=', $request->user_id)->paginate(2);
         return new DataTableCollectionResource($familyMembers);
    }

    public function deleteFamilyMember(Request $request){
        FamilyMember::where('id', '=', $request->id)->where('user_id', '=', $request->employer_id)->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
