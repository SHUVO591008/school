<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentClass;


class studentClassController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $class = studentClass::all();
        return view('backend.studentClass.studentClass',compact('class'));
    }

    



    public function add()
    {
        return view('backend.studentClass.addclass');
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
            'name'=>'required|unique:student_classes|min:3|max:55',
        ],
        [
            'name.required'=>'Class Name cannot be empty.',
            'name.min'=>'Class Name minimum 3 characters.',
            'name.max'=>'Class Name Not be greater then 55 characters..',
        ]);


       $data = new studentClass();
       $data->name = $request->name;
       $data->created_by = auth::user()->id;
       $users = $data->save();

       if($users){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.class.view'); 
        }else{
            toastr()->error('Data has been not Inserted');
            return back();  
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = studentClass::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentClass.addclass',compact('editData'));
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
            'name'=>'required|min:3|max:55|unique:student_classes,name,'.$id,

        ],
        [
            'name.required'=>'Class Name cannot be empty.',
            'name.min'=>'Class Name minimum 3 characters.',
            'name.max'=>'Class Name Not be greater then 55 characters..',
           
        ]);


        $data = studentClass::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $users = $data->update();
 
        if($users){
             toastr()->success('Data has been Updated');
             return redirect()->route('students.class.view'); 
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
        $find = studentClass::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }



}
