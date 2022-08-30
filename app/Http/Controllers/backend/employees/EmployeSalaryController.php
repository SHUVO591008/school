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
use DB;
use PDF;


class EmployeSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['allData'] = user::where('usertype','employee')->get();
        return view('backend.employee.employee_salary.employee-salary-view',$data);
    }


    public function increment($id)
    {  
        $data['allData'] = user::where('usertype','employee')
                                ->where('id',$id)
                                ->first();
         if($data['allData']==null){
            toastr()->error('Data not found');
            return redirect()->back(); 
         }                      
        return view('backend.employee.employee_salary.employee-salary-increment',$data);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function incrementstore(Request $request,$id)
    {
    
       
        $this->validate($request,[
            'incriment_salary'=>['required','regex:/^[0-9]+$/'],
            'effected_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'], 
        ],
        [
            'incriment_salary.required'=>'Incriment salary field cannot be empty.',
            'incriment_salary.regex'=>'Incriment salary field formate is invalid.',
            'effected_date.required'=>'Effected Date field cannot be empty.',
            'effected_date.regex'=>'Effected Date field formate is invalid.',
           
        ]);

        $user = user::where('usertype','employee')
                                ->where('id',$id)
                                ->first();
         if($user==null){
            toastr()->error('Data not found');
            return redirect()->back(); 
         }  

         $previous_salary = $user->salary;
         $present_salary = (float)$previous_salary+(float)$request->incriment_salary;
         $user->salary = $present_salary;
         $user->save();

         $salaryData = new EmployeSalaryLog;
         $salaryData->employe_id = $user->id;
         $salaryData->previous_salary = $previous_salary;
         $salaryData->present_salary = $present_salary;
         $salaryData->incriment_salary = $request->incriment_salary;
         $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
         $salaryData->save();

        toastr()->success('Salary increment succesfully');
        return redirect()->route('employe.salary.view'); 


    }

  

    public function show(Request $request, $id)
    {
        $data['details'] = user::find($id);
        if($data['details']==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }

        $data['salary_log'] = EmployeSalaryLog::where('employe_id',$data['details']->id)->get();

        return view('backend.employee.employee_salary.employee-salary-details',$data);
 
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 

        // $find = designation::find($request->id);
        // if($find==null){
        //     toastr()->error("Sorry!not try again.");
        //     return redirect()->back();
        // }
       
        // $find->delete();

    }
}
