<?php

namespace App\Http\Controllers\backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\assignstudent;
use App\model\discountstudent;
use App\user;
use App\model\studentGroup;
use App\model\studentShift;
use App\model\studentYear;
use App\model\studentClass;
use App\model\studentFeeAmount;
use App\model\studentFeeCategory;
use App\model\assignsubject;
use App\model\accountstudentfee;
use Validator;
use DB;
use PDF;

class StudentFeeController extends Controller
{
    public function index(Request $request){

        $data['allData'] = accountstudentfee::orderBy('id','DESC')->get();
        return view('backend.accounts.studentFee.accounts-student-fee',$data);
    }

    public function add(){

        $data['year'] = studentYear::orderBy('id','DESC')->get();
        $data['class'] = studentClass::all();
        $data['studentFeeCategory'] = studentFeeCategory::all();

        return view('backend.accounts.studentFee.accounts-student-fee-add',$data);
    }

    public function getStudent(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));


        $yearCheck = studentYear::where('id',$year_id)->first();
        $classCheck = studentClass::where('id',$class_id)->first();
        $feecategoryCheck = studentFeeCategory::where('id',$fee_category_id)->first();

        if(empty($yearCheck) || empty($classCheck) || empty($feecategoryCheck) || empty($date)){
            $arr = array('msg' => 'Oops! not try again', 'status' =>false);
            return response()->json($arr);
        }


         $allstudent = assignstudent::where('year_id',$year_id)
                        ->where('class_id',$class_id)
                        ->get();

         if(count($allstudent)==null){
             $arr = array('msg' => 'Data Not Found!', 'status' =>false);
             return response()->json($arr);
            //  return response()->json([$arr,$test]);

         }else{
 
         $html['thsource'] = '<th>SL</th>';
         $html['thsource'] .= '<th>ID No</th>';
         $html['thsource'] .= '<th>Student Name</th>';
         $html['thsource'] .= '<th>Father Name</th>';
         $html['thsource'] .= '<th>Original Fee</th>';
         $html['thsource'] .= '<th>Discount Amount</th>';
         $html['thsource'] .= '<th>Fee (This Student)</th>';
         $html['thsource'] .= '<th>Select</th>';
         $html['btn'] = '<button id="submitBtn" type="submit" class="btn btn-primary">Submit</button>';
 
  
         foreach ($allstudent as $key => $v) {
            $stuDiscount =discountstudent::where('class_id',$v->class_id)
                            ->where('year_id',$v->year_id)
                            ->where('fee_category_id',$fee_category_id)
                            ->where('assign_student_id',$v->id)
                            ->first();

            if($stuDiscount==null){
                $value = 0;
            }else{
                $value = $stuDiscount->discount;
            }
       
            $Fee = studentFeeAmount::where('fee_category_id',$fee_category_id)->where('class_id',$v->class_id)->first();
             $accountStudentFee = accountstudentfee::where('student_id',$v->student_id)
                                                    ->where('class_id',$v->class_id)
                                                    ->where('year_id',$v->year_id)
                                                    ->where('fee_category_id',$fee_category_id)
                                                    ->where('date',$date)
                                                    ->first();
            if($accountStudentFee !=null){
                $checked = 'checked';
            }else{
                $checked = '';
            }
             $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['name'].'<input type="hidden" name="year_id" value="'.$v->year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['fname'].'<input type="hidden" name="class_id" value="'.$v->class_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$Fee->amount.' TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';

            $html[$key]['tdsource'] .= '<td>'.$value.' %'.'</td>';
            
            
             $originafee = $Fee->amount;
                 
             $discounts = $value;       
             $discountablefee = $discounts/100*$originafee;
             $finalFee = (float)$originafee -(float)$discountablefee;

             $html[$key]['tdsource'] .= '<td>'.'<input class="form-control" type="text" name="amount[]" value="'.$finalFee.'" readonly>'.'</td>';
             $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$v->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;margin-top: 10px;">'.'</td>';

         }
 
         return response()->json(@$html);
             
         }
 
    }

    public function store(Request $request){


        $date = date('Y-m',strtotime($request->date));

        $yearCheck = studentYear::where('id',$request->year_id)->first();
        $classCheck = studentClass::where('id',$request->class_id)->first();
        $feecategoryCheck = studentFeeCategory::where('id',$request->fee_category_id)->first();

        if(empty($yearCheck) || empty($classCheck) || empty($feecategoryCheck) || empty($date)){
            toastr()->error("Oops! not try again");
            return redirect()->back();
        }




        $checkData = $request->checkmanage;

        accountstudentfee::where('class_id',$request->class_id)
                        ->where('year_id',$request->year_id)
                        ->where('fee_category_id',$request->fee_category_id)
                        ->where('date',$date)
                        ->delete();



        if($checkData !=null){

            for ($i=0; $i <count($checkData) ; $i++) { 
                
            if(empty($request->student_id[$checkData[$i]]) || empty($request->amount[$checkData[$i]])){
                toastr()->error("Oops! not try again");
                return redirect()->back();
            }


                $data = new accountstudentfee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->fee_category_id = $request->fee_category_id;
                $data->date = $date;
                $data->student_id = $request->student_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();

        }

    }

    if(!empty(@$data) || !empty($checkData)){
        toastr()->success("Well done! Successfuly update.");
        return redirect()->route('accounts.fee.grade.view');
    }else{
        toastr()->error("Opps sorry! Data not update.");
        return redirect()->back();
    }
                           
        

    }

    
}
