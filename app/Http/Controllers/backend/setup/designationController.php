<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\model\designation;

class designationController extends Controller
{
    public function index()
    {
        $data = designation::all();
        return view('backend.designation.designation',compact('data'));
    }

    public function add()
    {

        return view('backend.designation.Adddesignation');
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
            'name'=>'required|unique:designations|min:3|max:55',
        ],
        [
            'name.required'=>'Designation Name cannot be empty.',
            'name.min'=>'Designation Name minimum 3 characters.',
            'name.max'=>'Designation Name Not be greater then 55 characters..',
        ]);


       $data = new designation();
       $data->name = $request->name;
       $data->created_by = auth::user()->id;
       $users = $data->save();

       if($users){
            toastr()->success('Data has been Inserted');
            return redirect()->route('designation.view'); 
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
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $editData = designation::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.designation.Adddesignation',compact('editData'));
    
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
            
            'name'=>'required|min:3|max:55|unique:designations,name,'.$id,

        ],
        [
            'name.required'=>'Designation Name cannot be empty.',
            'name.min'=>'Designation Name minimum 3 characters.',
            'name.max'=>'Designation Name Not be greater then 55 characters..',
           
        ]);


        $data = designation::find($id);
        if($data==null){
            return back(); 
        }
        
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $exam = $data->update();
 
        if($exam){
            toastr()->success('Data has been Update');
            return redirect()->route('designation.view'); 
        }else{
            toastr()->error('Data has been not Update');
            return back();  
        }




    }

    // public function view(Request $request, $fee_category_id){

    //     $find = studentFeeAmount::where('fee_category_id',$fee_category_id)->first();

    //   if($find==null){
    //     toastr()->error("Opps!Please don't try this way.");
    //     return redirect()->back(); 
    //   }
        
    //     $data['view'] = studentFeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
    //     return view('backend.studentFeeAmount.detailsFeeAmount',$data);

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        $find = designation::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
