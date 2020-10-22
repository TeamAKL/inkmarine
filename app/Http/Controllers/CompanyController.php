<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('company.post');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request);
        Company::updateOrCreate(
            ['id' => $request->id,'name' =>$request->name],
            ['country' =>$request->country]
        ); 
        return response()->json(['message' => "success"], 200);
    }

    public function index()
    {
        $companies=Company::all();
        return view('company.index',compact('companies',$companies));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $company=Company::findOrFail($id);
    //     return view('company.edit',['company'=>$company]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Company  $company
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request)
    // {
    //     $company=Company::find($request->id);
    //     $company->name=$request->name;
    //     $company->country=$request->country;
    //     $company->save();
    //     return redirect('company');
    // }

    public function delete(Request $req)
    {
       $company=Company::find($req->id)->delete();
       return response()->json(['message' => "success"], 200);
    }

    public function getAllCompany(Request $req)
    {
        $companies=Company::all();
        return Datatables::of($companies)
        ->addColumn('action', function($data) {
            $html = "<button class='btn btn-primary edit-btn' data-id='$data->id' data-name='$data->name' data-country='$data->country' data-toggle='modal' data-target='#company-modal'>Edit</button>
                    <button class='btn btn-danger delete-btn' data-id='$data->id'>Delete</button>";
            return $html;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Company $company)
    // {
    //     //
    // }
}
