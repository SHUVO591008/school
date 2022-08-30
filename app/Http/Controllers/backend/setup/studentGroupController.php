<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentGroup;

class studentGroupController extends Controller
{
    public function index()
    {
        $group = studentGroup::all();
        return view('backend.studentGroup.studentGroup',compact('group'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.studentGroup.addgroup');
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
            'name'=>'required|unique:student_groups|min:4|max:55',
        ],
        [
            'name.required'=>'Group Name cannot be empty.',
            'name.min'=>'Group Name minimum 4 characters.',
            'name.max'=>'Group Name Not be greater then 55 characters..',
        ]);


        $data = new studentGroup();
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();

        if($data->save()){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.group.view'); 
        }
               


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = studentGroup::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentGroup.addgroup',compact('editData'));
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
            'name'=>'required|min:4|max:55|unique:student_groups,name,'.$id,
           

        ],
        [
            'name.required'=>'Group Name cannot be empty.',
            'name.min'=>'Group Name minimum 4 characters.',
            'name.max'=>'Group Name Not be greater then 55 characters..',
           
        ]);


        $data = studentGroup::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $users = $data->update();
 
        if($users){
             toastr()->success('Data has been Updated');
             return redirect()->route('students.group.view'); 
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
        $find = studentGroup::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
