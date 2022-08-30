<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentFeeCategory;

class studentFeeCategoryController extends Controller
{
    public function index()
    {
        $fee = studentFeeCategory::all();
        return view('backend.studentFeeCategory.studentFeeCategory',compact('fee'));
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
            'name'=>'required|unique:student_fee_categories|min:5|max:55',
        ],
        [
            'name.required'=>'Fee Category cannot be empty.',
            'name.min'=>'Fee Category minimum 5 characters.',
            'name.max'=>'Fee Category Not be greater then 55 characters..',
        ]);


        $data = new studentFeeCategory();
        $data->name = $request->name;
        $data->created_by = auth::user()->id;
        $data->save();

        if($data->save()){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.fee.category.view'); 
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
        return view('backend.studentFeeCategory.addFeeCategory');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = studentFeeCategory::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentFeeCategory.addFeeCategory',compact('editData'));
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
            'name'=>'required|min:5|max:55|unique:student_fee_categories,name,'.$id,
           

        ],
        [
            'name.required'=>'Fee Category cannot be empty.',
            'name.min'=>'Fee Category minimum 5 characters.',
            'name.max'=>'Fee Category Not be greater then 55 characters..',
           
        ]);


        $data = studentFeeCategory::find($id);
        if($data==null){
            return back(); 
        }
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $users = $data->update();
 
        if($users){
             toastr()->success('Data has been Updated');
             return redirect()->route('students.fee.category.view'); 
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
        $find = studentFeeCategory::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
