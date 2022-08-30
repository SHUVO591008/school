<?php

namespace App\Http\Controllers\backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\assignstudent;
use App\model\discountstudent;
use App\user;
use App\model\studentGroup;
use App\model\studentShift;
use App\model\studentYear;
use App\model\studentClass;
use App\model\designation;
use App\model\EmployeSalaryLog;
use App\model\leavePurpose;
use App\model\employeeLeave;
use App\model\EmployeAttendence;
use DB;
use PDF;

class EmployeMonthlySalaryControlle extends Controller
{
    public function view(){
        return view('backend.employee.employee_monthly_salary.employee-monthly-salary');
    }

    public function getSalary(Request $request){

        $date = date('Y-m',strtotime($request->date));
        if($date !==''){
            $where[] =['date','like',$date.'%'];
           }
    
            $data = EmployeAttendence::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();

    
            if(count($data)==null){
                $arr = array('msg' => 'Data Not Found!', 'status' =>false);
                return response()->json($arr);
            }else{


                $html['date'] = ' Month of Salary :'.date('M-Y',strtotime($request->date));


                $html['thsource'] = '<th>SL</th>';
                $html['thsource'] .= '<th>Employee Name</th>';
                $html['thsource'] .= '<th>Basic Salary</th>';
                $html['thsource'] .= '<th>Salary(This Month)</th>';
                $html['thsource'] .= '<th>Action</th>';

            
        
                foreach ($data as $key => $v) {
                    $totalatt = EmployeAttendence::with(['user'])->where($where)->where('employee_id',$v->employee_id)->get();
                    $absentcount = count($totalatt->where('att_stutas','Absent'));
                    $attdaycount= count($totalatt);

                
                    $color = 'success';

                    $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['user']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['user']['salary'].'</td>';

                    $salary = (float)$v['user']['salary'];
                    $salaryperday = $salary/30;
                    $salaryminus = (float)$absentcount*(float)$salaryperday;
                    $salarydaywisetotal =$salaryperday*$attdaycount;
                    
                    $totalsalary = (float)$salarydaywisetotal-$salaryminus;

                    $html[$key]['tdsource'] .= '<td>'.$totalsalary.'</td>';
                    $html[$key]['tdsource'] .= '<td>';
                    $html[$key]['tdsource'] .= '<a class="btn btn-'.$color.'" title="Payslip" target="_blank" href="'.route("employe.monthly.salary.pay-slip",$v->employee_id).'?date='.$date.'">Fee Slip</a> ';

                    $html[$key]['tdsource'] .= '</td>';
                }

            
    
                return response()->json(@$html);
                
            }


    }

    public function payslip(Request $request,$employee_id){

       if(!$request->date){
        toastr()->error("Sorry!not try again.");
        return redirect()->back();
       }

      
        $where[] =['date','like',$request->date.'%'];

        $data['totalattgroupbyid'] = EmployeAttendence::where('employee_id',$employee_id)->where($where)->get();

        if(count($data['totalattgroupbyid'])==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }

        $pdf = PDF::loadView('backend.employee.employee_monthly_salary.employee-monthly-salary-pdf',$data);
        return $pdf->stream('employee-monthly-salary.pdf');
    }


}
