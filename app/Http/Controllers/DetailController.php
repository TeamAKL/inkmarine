<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;
use App\EmployeerDetail;
use App\FamilyMember;
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
    	$family_members = FamilyMember::select(DB::Raw("family_members.*, DATE_FORMAT(family_members.dob, '%Y-%m-%d') as date_of_birth"))->where('user_id', '=', $req->user_id)->get();
    	return response()->json(['family_members' => $family_members], 200);
    }
}
