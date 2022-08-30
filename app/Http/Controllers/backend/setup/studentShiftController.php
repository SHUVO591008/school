<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentShift;

class studentShiftController extends Controller
{
    public function index()
    {
        $shift = studentShift::all();
        return view('backend.studentShift.studentShift',compact('shift'));
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
            'name'=>'required|unique:student_shifts|min:6|max:55',
        ],
        [
            'name.required'=>'Shift cannot be empty.',
            'name.min'=>'Shift minimum 6 characters.',
            'name.max'=>'Shift Not be greater then 55 characters..',
        ]);


        $data = new studentShift();
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();

        if($data->save()){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.shift.view'); 
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
        return view('backend.studentShift.addshift');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = studentShift::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentShift.addshift',compact('editData'));
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
            'name'=>'required|min:6|max:55|unique:student_shifts,name,'.$id,
           

        ],
        [
            'name.required'=>'Shift cannot be empty.',
            'name.min'=>'Shift minimum 4 characters.',
            'name.max'=>'Shift Not be greater then 55 characters..',
           
        ]);


        $data = studentShift::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $users = $data->update();
 
        if($users){
             toastr()->success('Data has been Updated');
             return redirect()->route('students.shift.view'); 
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
        $find = studentShift::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
