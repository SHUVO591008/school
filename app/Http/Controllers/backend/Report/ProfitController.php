<?php

namespace App\Http\Controllers\backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\accountstudentfee;
use App\model\cost;
use App\model\AccountEmployeeSalary;
use PDF;

class ProfitController extends Controller
{
    public function index(){
        return view('backend.report.report-view');
    }

    public function profit(Request $request){

        $star_date = date('Y-m-d',strtotime($request->star_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        $s_date = date('Y-m',strtotime($request->star_date));
        $e_date = date('Y-m',strtotime($request->end_date));

        $student_fee = accountstudentfee::whereBetween('date',[$s_date,$e_date])->sum('amount');
        $other_cost = cost::whereBetween('expense_date',[$star_date, $end_date])->sum('amount'); 
        $employee_salary = AccountEmployeeSalary::whereBetween('date',[$s_date,$e_date])->sum('amount'); 

        $total_cost = $other_cost+$employee_salary;
        $profit = $student_fee-$total_cost;

        if(empty($student_feet) && empty($other_cost) && empty($employee_salary)){
            $arr = array('msg' => 'Data Not Found!', 'status' =>false);
            return response()->json($arr);
        }else{

            if($total_cost>$profit){
                $remarks = "Loss";
            }elseif($total_cost==$profit){
                $remarks = "Equal ";
            }else{
                $remarks = "Profit";
            }
    
                $html['date'] = 'Monthly/Yearly Profit :'.date('d-M-Y',strtotime($star_date)).' TO '.date('d-M-Y',strtotime($end_date));
                $html['thsource'] = '<th>Student Fee</th>';
                $html['thsource'] .= '<th>Other Cost</th>';
                $html['thsource'] .= '<th>Salary</th>';
                $html['thsource'] .= '<th>Total Cost</th>';
                $html['thsource'] .= '<th>Profit/Loss</th>';
                $html['thsource'] .= '<th>Remarks</th>';
                $html['thsource'] .= '<th>Action</th>';
    
                $color = 'warning';
    
                $tk = ' TK';
                $html['tdsource'] = '<td>'.number_format($student_fee,2).$tk.'</td>';
                $html['tdsource'] .= '<td>'.number_format($other_cost,2).$tk.'</td>';
                $html['tdsource'] .= '<td>'.number_format($employee_salary,2).$tk.'</td>';
                $html['tdsource'] .= '<td>'.number_format($total_cost,2).$tk.'</td>';
                $html['tdsource'] .= '<td>'.number_format($profit,2).$tk.'</td>';
                $html['tdsource'] .= '<td>'.$remarks.'</td>';
                $html['tdsource'] .= '<td>';
                $html['tdsource'] .= '<a target="_blank" class="btn btn-'.$color.'" title="PDF" href="'.route("report.pdf").'?start_date='.$star_date.'&end_date='.$end_date.'"><i class="fa fa-file" aria-hidden="true"></i></a>';
                $html['tdsource'] .='</td>';
    
                return response()->json(@$html);

        }

        
        
    }

    public function pdf(Request $request){


        $data['star_date']= date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $data['s_date'] = date('Y-m',strtotime($request->start_date));
        $data['e_date'] = date('Y-m',strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.report-pdf-view',$data);
        $pdf->SetProtection(['copy','print'],'','pass');
        return $pdf->stream('monthly-yearly-profit.pdf');

    }




}
