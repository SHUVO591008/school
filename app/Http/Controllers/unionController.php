<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Division;
use App\District;
use App\Upazila;
use App\union;

class unionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = union::get();

        return view('backend.union.union',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unionadd()
    {
        $Division = Division::all();
        $District = District::all();
        $Upazila = Upazila::all();

        return view('backend.union.addunion',compact('Division','District','Upazila'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'division_id'=>'required|numeric',
            'district_id'=>'required|numeric',
            'upazila_id'=>'required|numeric',
            'name'=>'required|unique:unions,name',
        ]);

        $data = new union();
        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->upazila_id = $request->upazila_id;
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();
 
        
        toastr()->success('Data has been Inserted');
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = union::find($id);
        $Division = Division::all();
      
     
        if($editData==null){
            return back(); 
        }
        
        return view('backend.union.addunion',compact('editData','Division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'division_id'=>'required|numeric',
            'district_id'=>'required|numeric',
            'upazila_id'=>'required|numeric',
            'name'=>'required|unique:unions,name,'.$id,
        ]);

        $data = union::find($id);
        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->upazila_id = $request->upazila_id;
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $data->update();
 
        
        toastr()->success('Data has been Updated');
        return redirect()->route('union.view'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = union::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();
    }
}
