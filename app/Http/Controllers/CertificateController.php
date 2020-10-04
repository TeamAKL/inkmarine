<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view('certificate.post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Certificate::create([
            'title'=>$request->title
        ]);
        return redirect('certificate');
    }

    public function index()
    {
        $certificates=Certificate::all();
        return view('certificate.index',compact('certificates',$certificates));  
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
    public function edit($id)
    {
        $certificate=Certificate::findOrFail($id);
        return view('certificate.edit',['certificate'=>$certificate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $certificate=Certificate::find($request->id);
        $certificate->title=$request->title;
        $certificate->save();
       return redirect('certificate');
    }

    public function delete($id)
    {
       $certificate=Certificate::find($id)->delete();
       return redirect('certificate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Certificate $certificate)
    // {
    //     //
    // }
}