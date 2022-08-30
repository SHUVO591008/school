<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $allData = Division::all();
       
        return view('backend.division.division',compact('allData'));
    }


    
    public function Divisionadd()
    {
        return view('backend.division.adddivision');
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
        $this->validate($request,[
            'name'=>'required|unique:divisions,name',
        ]);

        $data = new Division();
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();
 
        
        toastr()->success('Data has been Inserted');
        return redirect()->route('division.view'); 
         


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
        $editData = Division::find($id);
        
        if($editData==null){
            return back(); 
        }
        return view('backend.division.adddivision',compact('editData'));
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
            'name'=>'required|unique:divisions,name,'.$id,
        ]);


        
    
        $data = Division::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
         $data->update();
 
      
        toastr()->success('Data has been Updated');
        return redirect()->route('division.view'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $find = Division::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();
    }
}
