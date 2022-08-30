<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\assignstudent;
use App\model\discountstudent;
use App\user;
use App\model\studentGroup;
use App\model\studentShift;
use App\model\studentYear;
use App\model\studentClass;
use DB;
use PDF;
use Validator;

class StudentRollgenerateController extends Controller
{
    public function rollgenerate()
    {
        $data['year'] = studentYear::orderBy('id', 'DESC')->get();
        $data['class'] = studentClass::all();
        return view('backend.student.student_roll.student-roll-generate',$data);
    }


    public function validation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'roll.*' => 'required|numeric',
            'student_id.*' => 'required|numeric',

        ],
        [
            'roll.*required'=>'The roll field is mandatory',
            'roll.*numeric'=>'The field is only Number',
            'student_id.*required'=>'The student field is mandatory',
            'student_id.*numeric'=>'The field is only Number',
            
        ]);



        if ($validator->passes()) {

            $class_id = $request->class_id;
            $year_id = $request->year_id;

            if($request->student_id !=null){
                for ($i=0; $i < count($request->student_id) ; $i++) { 

                    assignstudent::where('class_id',$class_id)
                                    ->where('year_id',$year_id)
                                    ->where('student_id',$request->student_id[$i])
                                    ->update(['roll'=>$request->roll[$i]]);          
                  
                }

                // $arr = array('success' => 'Data Not Found!', 'url' =>route('student.reg.view'));
                return response()->json('success');
           
               
            }else{
                return response()->json(['error'=>'somthing wrong......']);
            }

 
			
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    
    }




    public function search(Request $request)
    {


       $allData = assignstudent::with(['studentData'])->where('class_id',$request->class_id)->where('year_id',$request->year_id)->get();


       if(count($allData)==null){
        $arr = array('msg' => 'Data Not Found!', 'status' =>false);
            return response()->json($arr);
        }else{
            return response()->json($allData);
        }
      

    //    dd($allData->toArray());
       
       
    }

}
