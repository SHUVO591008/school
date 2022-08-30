<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentClass;
use App\model\subject;
use App\model\assignsubject;
use Validator;

class studentassignsubjectController extends Controller
{
    public function index()
    {
        $data = assignsubject::select('class_id')->groupBy('class_id')->orderBy('class_id', 'ASC')->get();
        return view('backend.studentassignsubject.studentassignsubject',compact('data'));
    }

    public function add()
    {
        $data['subject'] = subject::all();
        $data['class'] = studentClass::all();
        return view('backend.studentassignsubject.addassignsubject',$data);
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
            'class_id'=>'required',
            'subject_id.*'=>'required',
            'full_marks.*'=>'required|numeric',  
            'pass_marks.*'=>'required|numeric',  
            'subjective_marks.*'=>'required|numeric',  
        ],
        [
            'class_id.required'=>'Please Select The Class.',
            'subject_id.*.required'=>'Please Select The Subject.',
            'full_marks.*.required'=>'Please Enter The Full Marks.',
            'pass_marks.*.required'=>'Please Enter The Pass Marks.',
            'subjective_marks.*.required'=>'Please Enter The Subjective Marks.',
            'full_marks.*.numeric'=>'The field must be number.',
            'pass_marks.*.numeric'=>'The field must be number.',
            'subjective_marks.*.numeric'=>'The field must be number.',
            
        ]);

         //Class check   
        $classcheck = studentClass::where('id',$request->class_id)->first();

        if($classcheck==null){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }



        
        foreach ($request->subject_id as $key => $value) {

            //subject id check
            $subjectcheck = subject::where('id',$request->subject_id[$key])->first();
         
            if($subjectcheck==null){
             toastr()->error("Opps!Please don't try this way.");
             return redirect()->back(); 
            }

            //data insert 1st way
            // $data = array(
            //     'fee_category_id'=>$request->fee_category_id,
            //     'class_id'=>$request->class_id[$key],
            //     'amount'=>$request->amount[$key],
            // );

            // $insert = DB::table('student_fee_amounts')->insert($data);   
            
        }


        //data insert 2nd way
        $count = count($request->subject_id);
        for ($i=0; $i <$count ; $i++) { 

            $data = new assignsubject();
            $data->class_id = $request->class_id;
            $data->subject_id = $request->subject_id[$i];
            $data->full_marks = $request->full_marks[$i];
            $data->pass_marks = $request->pass_marks[$i];
            $data->subjective_marks = $request->subjective_marks[$i];
            $data->created_by=auth::user()->id;
            $save = $data->save();
        }

        if($save){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.assign.subject.view'); 
        }else{
            toastr()->error('Data has been not Inserted');
            return redirect()->back(); 
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
    public function edit($class_id)
    {

        $data['editData'] = assignsubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        $data['class'] = studentClass::all();
        $data['subject'] = subject::all();

       $count = count($data['editData']);

        if($count==0){
            toastr()->error('Data not Found!');
            return back(); 
        }

        return view('backend.studentassignsubject.editassignsubject',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {



        if($request->class_id==NULL){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }
       

        $this->validate($request,[
            'class_id'=>'required',
            'subject_id.*'=>'required',
            'full_marks.*'=>'required|numeric',  
            'pass_marks.*'=>'required|numeric',  
            'subjective_marks.*'=>'required|numeric',  
        ],
        [
            'class_id.required'=>'Please Select The Class.',
            'subject_id.*.required'=>'Please Select The Subject.',
            'full_marks.*.required'=>'Please Enter The Full Marks.',
            'pass_marks.*.required'=>'Please Enter The Pass Marks.',
            'subjective_marks.*.required'=>'Please Enter The Subjective Marks.',
            'full_marks.*.numeric'=>'The field must be number.',
            'pass_marks.*.numeric'=>'The field must be number.',
            'subjective_marks.*.numeric'=>'The field must be number.',
            
        ]);

         //subject category check   
        $subjectidchack = subject::where('id',$request->subject_id)->first();
        if($subjectidchack==null){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }

        if($request->subject_id==null){
            toastr()->error("Opps!You do select any item.");
            return redirect()->back(); 
        }else{
             //data insert
           $test =  assignsubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();

       

            foreach ($request->subject_id as $key => $value) {

               

                $subjectcheck = subject::where('id',$request->subject_id[$key])->first();

                if($subjectcheck==null){
                 toastr()->error("Opps!Please don't try this way.");
                 return redirect()->back(); 
                }


                $assignsubject_exist = assignsubject::where('subject_id',$request->subject_id[$key])
                                                        ->where('class_id',$request->class_id)
                                                        ->first();

                  
                if($assignsubject_exist){
                    $assignsubject = $assignsubject_exist;
                
                }else{
                    $assignsubject = new assignsubject();
                }
                $assignsubject->class_id = $request->class_id;
                $assignsubject->subject_id = $request->subject_id[$key];
                $assignsubject->full_marks = $request->full_marks[$key];
                $assignsubject->pass_marks = $request->pass_marks[$key];
                $assignsubject->subjective_marks = $request->subjective_marks[$key];
                $assignsubject->created_by = auth::user()->id;
                $save = $assignsubject->save();

              

           
            }

            if($save){
                toastr()->success('Data has been Update');
                return redirect()->route('students.assign.subject.view'); 
            }else{
                toastr()->error('Data has been not Update');
                return redirect()->back(); 
            }

        }
        
       

       

     
               

    }

    public function view(Request $request, $class_id){

        $find = assignsubject::where('class_id',$class_id)->first();

      if($find==null){
        toastr()->error("Opps!Please don't try this way.");
        return redirect()->back(); 
      }
        
        $data['view'] = assignsubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        return view('backend.studentassignsubject.detailsassignsubject',$data);
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // { 
    //     $find = studentFeeCategory::find($request->id);
    //     if($find==null){
    //         toastr()->error("Sorry!not try again.");
    //         return redirect()->back();
    //     }
       
    //     $find->delete();

    // }
}
