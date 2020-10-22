<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CertificateController extends Controller
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
    //     return view('certificate.post');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Certificate::updateOrCreate(
            ['id' => $request->id],
            ['title'=>$request->title]
        ); 
        return response()->json(['message' => "success"], 200);
    }

    public function index()
    {
        // $certificates=Certificate::all();
        return view('certificate.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $certificate=Certificate::findOrFail($id);
    //     return view('certificate.edit',['certificate'=>$certificate]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Certificate  $certificate
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request)
    // {
    //     $certificate=Certificate::find($request->id);
    //     $certificate->title=$request->title;
    //     $certificate->save();
    //    return redirect('certificate');
    // }

    public function delete(Request $req)
    {
       $certificate=Certificate::find($req->id)->delete();
       return response()->json(['message' => "success"], 200);
    }

    /** 
     * GET ALL CERTIFICATE
    */
    public function getAllCertificate(Request $req)
    {
        $certificates=Certificate::all();
        return Datatables::of($certificates)
        ->addColumn('action', function($data) {
            $html = "<button class='btn btn-primary edit-btn' data-id='$data->id' data-title='$data->title' data-toggle='modal' data-target='#certificate-modal'>Edit</button>
                    <button class='btn btn-danger delete-btn' data-id='$data->id'>Delete</button>";
            return $html;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

}
