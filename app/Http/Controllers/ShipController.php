<?php

namespace App\Http\Controllers;

use App\Ship;
use Illuminate\Http\Request;
use App\Company;

class ShipController extends Controller
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
        $companies=Company::all();
        return view('ship.post')->with(['companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ship::create([
            'ship_name'=>$request->ship_name,
            'ship_type'=>$request->ship_type,
            'grt'=>$request->grt,
            'kw'=>$request->kw,
            'area'=>$request->area,
            'company_id'=>$request->company_id

        ]);
        return redirect('ship');
    }

    public function index()
    {
        $companies=Company::all();
        $ships=Ship::all();
        return view('ship.index')->with(['ships'=>$ships])->with(['companies'=>$companies]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies=Company::all();
        $ship=Ship::findOrFail($id);
        return view('ship.edit')->with(['ship'=>$ship])->with(['companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ship=Ship::find($request->id);
        $ship->ship_name=$request->ship_name;
        $ship->ship_type=$request->ship_type;
        $ship->grt=$request->grt;
        $ship->kw=$request->kw;
        $ship->area=$request->area;
        $ship->company_id=$request->company_id;
        $ship->save();
        return redirect('ship');
    }

    public function delete($id)
    {
       $ship=Ship::find($id)->delete();
       return redirect('ship');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ship $ship)
    {
        //
    }
}
