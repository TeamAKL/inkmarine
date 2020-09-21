<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getalluser(Request $req)
    {
       $users = User::orderBy('created_at', $req->dir)->paginate($req->length);
       if(!empty($req->search)) {
           $search = $req->search;
           $query = User::where(function($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
           });
           $users = $query->paginate($req->length);
       }

        return new DataTableCollectionResource($users);
    }

    public function saveFormOne(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'crewcode' => 'required',
            'name' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'pob' => 'required',
            'edulevel' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        dd($req->all());
        return response()->json(["message" => "success"], 200);
    }
}
