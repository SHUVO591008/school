<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentYear;


class studentYearController extends Controller
{
    public function index()
    {
        $year = studentYear::all();
        return view('backend.studentYear.studentYear',compact('year'));
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
        
        $valid = $this->validate($request,[
            'name'=>'required|unique:student_years|min:4|max:55',
        ],
        [
            'name.required'=>'Year cannot be empty.',
            'name.min'=>'Year minimum 4 characters.',
            'name.max'=>'Year Not be greater then 55 characters..',
        ]);


        $data = new studentYear();
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();

        if($data->save()){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.year.view'); 
        }
               


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.studentYear.addyear');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = studentYear::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentYear.addyear',compact('editData'));
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
            'name'=>'required|min:4|max:55|unique:student_years,name,'.$id,
           

        ],
        [
            'name.required'=>'Year cannot be empty.',
            'name.min'=>'Year minimum 4 characters.',
            'name.max'=>'Year Not be greater then 55 characters..',
           
        ]);


        $data = studentYear::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $users = $data->update();
 
        if($users){
             toastr()->success('Data has been Updated');
             return redirect()->route('students.year.view'); 
         }else{
             toastr()->error('Data has been not Update.');
             return back();  
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
        $find = studentYear::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
