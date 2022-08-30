<?php

namespace App\Http\Controllers\backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use App\model\EmployeSalaryLog;
use App\model\EmployeAttendence;
use App\model\AccountEmployeeSalary;
use DB;
use PDF;

class EmployeeSalaryController extends Controller
{
   
    public function index(){

        $data['allData'] = AccountEmployeeSalary::orderBy('id','DESC')->get();
        return view('backend.accounts.salary.accounts-employee-salary',$data);
    }

    public function add(){
        return view('backend.accounts.salary.accounts-employee-salary-add');
    }

    public function getemployee(Request $request){


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
            $html['thsource'] .= '<th>ID No</th>';
            $html['thsource'] .= '<th>Employee Name</th>';
            $html['thsource'] .= '<th>Basic Salary</th>';
            $html['thsource'] .= '<th>Salary(This Month)</th>';
            $html['thsource'] .= '<th>Action</th>';
            $html['btn'] = '<button style="margin-left:31px" id="submitBtn" type="submit" class="btn btn-primary">Submit</button>';

           
    
            foreach ($data as $key => $v) {
                $account_salary = AccountEmployeeSalary::where('employee_id',$v->employee_id)->where('date',$date)->first();
                if( $account_salary !=null){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                $totalatt = EmployeAttendence::with(['user'])->where($where)->where('employee_id',$v->employee_id)->get();
                $absentcount = count($totalatt->where('att_stutas','Absent'));
                $attdaycount= count($totalatt);

              
                $color = 'success';

                $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['user']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['user']['salary'].' Tk'.'</td>';

                $salary = (float)$v['user']['salary'];
                $salaryperday = $salary/30;
                $salaryminus = (float)$absentcount*(float)$salaryperday;
                $salarydaywisetotal =$salaryperday*$attdaycount;
                
                $totalsalary = (float)$salarydaywisetotal-$salaryminus;

                $html[$key]['tdsource'] .= '<td>'.number_format($totalsalary,2).' Tk'.'<input type="hidden" name="amount[]" value="'.$totalsalary.'">'.'</td>';
            

                $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$v->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;margin-top: 10px;">'.'</td>';

                
            }

            
            return response()->json(@$html);
                
            }

 
    }

    public function store(Request $request){


        $date = date('Y-m',strtotime($request->date));
        $checkData = $request->checkmanage;

       

    
        if($date !==''){
            $where[] =['date','like',$date.'%'];
           }


           AccountEmployeeSalary::where('date',$date)->delete();

           if($checkData !=null){
         
            for ($i=0; $i<count($checkData); $i++) { 

                if(empty($request->employee_id[$checkData[$i]]) || empty($request->amount[$checkData[$i]])){
                                toastr()->error("Oops! not try again");
                                return redirect()->back();
                }
                
              

                
                $data = EmployeAttendence::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->where('employee_id',$request->employee_id[$checkData[$i]])->get();

      
                foreach($data as $key => $v){

                    $totalatt = EmployeAttendence::with(['user'])->where($where)->where('employee_id',$request->employee_id[$checkData[$i]])->get();
                    $absentcount = count($totalatt->where('att_stutas','Absent'));
                    $attdaycount= count($totalatt);
        
                    $salary = (float)$v['user']['salary'];
         
                    $salaryperday = $salary/30;
                    $salaryminus = (float)$absentcount*(float)$salaryperday;
                    $salarydaywisetotal =$salaryperday*$attdaycount;
                    
                    $totalsalary = (float)$salarydaywisetotal-$salaryminus;

                    $AccountEmployeecheck = AccountEmployeeSalary::where('employee_id',$v->employee_id)->where('date',$date)->get();
                    if(count($AccountEmployeecheck)==0){
                        $data = new AccountEmployeeSalary();
                        $data->date = $date;
                        $data->employee_id = $v->employee_id;
                        $data->amount = $totalsalary;
                        $data->save();
                    }else{

                        toastr()->error("Opps! Data all ready inserted.");
                        return redirect()->back();
                    }
                    
    
                }
    
    
               }

            }

            if(!empty(@$data) || !empty($checkData)){
                toastr()->success("Well done! Successfuly update.");
                return redirect()->route('accounts.employee.salary.view');
            }else{
                toastr()->error("Opps! Data all Delete.");
                return redirect()->back();
            }

          
          



    }

    


    

    



}
