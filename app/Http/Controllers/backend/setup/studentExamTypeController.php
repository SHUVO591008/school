<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use App\model\ExamType;
use Validator;

class studentExamTypeController extends Controller
{
    public function index()
    {
        $data = ExamType::all();
        return view('backend.studentExamType.ExamType',compact('data'));
    }

    public function add()
    {

        return view('backend.studentExamType.AddExamType');
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
            'name'=>'required|unique:exam_types|min:3|max:55',
        ],
        [
            'name.required'=>'Exam Name cannot be empty.',
            'name.min'=>'Exam Name minimum 3 characters.',
            'name.max'=>'Exam Name Not be greater then 55 characters..',
        ]);


       $data = new ExamType();
       $data->name = $request->name;
       $data->created_by = auth::user()->id;
       $users = $data->save();

       if($users){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.exam.type.view'); 
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

        $editData = ExamType::find($id);
        if($editData==null){
            return back(); 
        }
        return view('backend.studentExamType.AddExamType',compact('editData'));
    
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
            
            'name'=>'required|min:3|max:55|unique:exam_types,name,'.$id,

        ],
        [
            'name.required'=>'Exam Name cannot be empty.',
            'name.min'=>'Exam Name minimum 3 characters.',
            'name.max'=>'Exam Name Not be greater then 55 characters..',
           
        ]);


        $data = ExamType::find($id);
        if($data==null){
            return back(); 
        }
        
        $data->name = $request->name;
        $data->update_by = auth::user()->id;
        $exam = $data->update();
 
        if($exam){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.exam.type.view'); 
        }else{
            toastr()->error('Data has been not Inserted');
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
        $find = ExamType::find($request->id);
        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
       
        $find->delete();

    }
}
