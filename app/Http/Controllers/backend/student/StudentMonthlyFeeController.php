<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\assignstudent;
use App\model\discountstudent;
use App\model\studentFeeAmount;

use App\user;
use App\model\studentGroup;
use App\model\studentShift;
use App\model\studentYear;
use App\model\studentClass;
use DB;
use PDF;
use Validator;

class StudentMonthlyFeeController extends Controller
{
    public function generate()
    {
        $data['year'] = studentYear::orderBy('id', 'DESC')->get();
        $data['class'] = studentClass::all();
        return view('backend.student.monthlyfee.student-monthly-fee',$data);
    }


    public function getstudent(Request $request)
    {

       
       $year_id = $request->year_id;
       $class_id = $request->class_id;

       if($year_id !==''){
           $where[] =['year_id','like',$year_id.'%'];
       }

       if($class_id !==''){
        $where[] =['class_id','like',$class_id.'%'];
       }
      

        $allstudent = assignstudent::with(['studentmonthdiscount'])->where($where)->get();
        
        if(count($allstudent)==null){
            $arr = array('msg' => 'Data Not Found!', 'status' =>false);
            return response()->json($arr);
        }else{

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';

 
        foreach ($allstudent as $key => $v) {
            
            $registrationFee = studentFeeAmount::where('fee_category_id','1')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['studentData']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationFee->amount.' TK'.'</td>';
            
            $html[$key]['tdsource'] .= '<td>'.$v['studentmonthdiscount']['discount'].' %'.'</td>';
           
           

            $originafee = $registrationFee->amount;
                
            $discount = $v['studentmonthdiscount']['discount'];       
            $discountablefee = $discount/100*$originafee;
            $finalFee = (float)$originafee -(float)$discountablefee;
            

            $html[$key]['tdsource'] .= '<td>'.$finalFee.' Tk'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-'.$color.'" title="Payslip" target="_blank" href="'.route("monthly.getStudent.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'">Fee Slip</a> ';
            $html[$key]['tdsource'] .= '</td>';
        }


        return response()->json(@$html);
            
        }

        

       
    }

 

    public function payslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
       
        $data['month'] = $request->month;
        $data['std'] = assignstudent::with(['studentmonthdiscount','studentData'])
                            ->where('student_id',$student_id)
                            ->where('class_id',$class_id)
                            ->first();

        $pdf = PDF::loadView('backend.student.monthlyfee.student-monthly-fee-details',$data);
        $pdf->setProtection(['copy','print'],'','pass');
        return $pdf->stream('student_monthly_fee.pdf');                   
    }
}
