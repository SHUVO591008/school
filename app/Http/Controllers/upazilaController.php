<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Division;
use App\District;
use App\Upazila;
use App\union;

class upazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$allData = Upazila::get();
       
        $division = Upazila::select('division_id')->groupBy('division_id')->paginate(5);
        
        return view('backend.upazila.upazila',compact('division'));
    }

    public function upazilaadd()
    {
        $Division = Division::all();
        $District = District::all();

        return view('backend.upazila.addupazila',compact('Division','District'));
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
            'division_id'=>'required|numeric',
            'district_id'=>'required|numeric',
            'name'=>['required'],
        ]);


        for ($i=0; $i < count($request->name) ; $i++) { 
            $name = $request->name[$i];
            $DataChack  = Upazila::where('name',$name)->first();

            if($DataChack==null){

                $data = new Upazila();
                $data->division_id = $request->division_id;
                $data->district_id = $request->district_id;
                $data->name = $request->name[$i];
                $data->created_by = auth::user()->id;
                $test = $data->save();

            
            }


          
        }

        if(@$test){
            //toastr()->success('Data has been Inserted');
            return redirect()->back()->withMessage('Data has been Inserted'); 
           }else{
           // toastr()->error('Data Not Inserted');
            return redirect()->back()->withMessage('Data Not Inserted');
           }


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

        $editData = Upazila::where('district_id',$id)->first();

        if($editData==null){
            return redirect()->back()->withMessage('Data Not Found!'); 
        }

        $Division = Division::all();
     
        
        
        return view('backend.upazila.addupazila',compact('editData','Division'));
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
            'name'=>['required'],
        ]);

       
        $check = union::where('division_id',$request->division_id)->select('upazila_id')->groupBy('upazila_id')->get();

        $DataDelete = Upazila::whereNotIn('id',$check)->where('division_id',$request->division_id)->delete();
        

        for ($i=0; $i < count($request->name) ; $i++) { 
            $name = $request->name[$i];
            $DataChack  = Upazila::where('name',$name)->first();

            if($DataChack==null){

                $data = new Upazila();
                $data->division_id = $request->division_id;
                $data->district_id = $request->district_id;
                $data->name = $request->name[$i];
                $data->update_by = auth::user()->id;
                $test = $data->save();

            }

          
        }

        if(@$test){
            //toastr()->success('Data has been Inserted');
            return redirect()->back()->withMessage('Data has been Updated'); 
           }else{
           // toastr()->error('Data Not Inserted');
            return redirect()->back()->withMessage('Data Not Updated');
           }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
   

        $find = Upazila::where('district_id',$request->id)->get();

        if(count($find)==0){
            
            return redirect()->route('district.view')->withMessage('Sorry!not try again.');
        }

        $DataDelete = Upazila::where('district_id',$request->id)->delete();


    }
}
