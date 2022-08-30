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
use DB;
use PDF;

class EmployeLeaveControlle extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['allData'] = employeeLeave::orderBy('id','desc')->get();
        return view('backend.employee.employee_leave.employee-leave-view',$data);
    }


    public function add()
    {  
        $data['leavePurpose'] = leavePurpose::all();
        $data['employee'] = user::where('usertype','employee')->get();
        return view('backend.employee.employee_leave.employee-leave-add',$data);
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
    public function store(Request $request)
    {


        $this->validate($request,[
            'employee_id'=>'required',
            'leave_purpose_id'=>'required',
            'start_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
            'end_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
        ],
        [
            'employee_id.required'=>'Please select employe name.',
            'leave_purpose_id.required'=>'Please select leave purpose.',
            'start_date.required'=>'Start date field cannot be empty.',
            'start_date.regex'=>'Start date field formate is invalid.',
            'end_date.required'=>'End date field cannot be empty.',
            'end_date.regex'=>'End date field formate is invalid.',
           
        ]);

    
        //employe validation
        if($request->employee_id){
            $userCheck = user::where('usertype','employee')->where('id',$request->employee_id)->first();
            if($userCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }

    

        //employe validation
        $getID = $request->leave_purpose_id;
        
        if($getID){
            $leave = leavePurpose::where('id',$getID)->first();

            if($leave==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }      
                
        }elseif($getID==0){
            $this->validate($request,[
                'name'=>'required|unique:leave_purposes',
            ],
            [
                'name.required'=>'Please write leave purpose.',
            ]);
        }

        if($getID==0){
            $leavePurpose = new leavePurpose();
            $leavePurpose->name  = $request->name;
            $leavePurpose->save();
            $leave_purpose_id  = $leavePurpose->id;
        }else{
            $leave_purpose_id  = $request->leave_purpose_id;
        }

        $employeeLeave  =new employeeLeave();
        $employeeLeave->employee_id = $request->employee_id;
        $employeeLeave->leave_purpose_id = $leave_purpose_id;
        $employeeLeave->start_date  = date('Y-m-d',strtotime($request->start_date));
        $employeeLeave->end_date  = date('Y-m-d',strtotime($request->end_date));
        $employeeLeave->save();

        toastr()->success('Data has been Inserted');
        return redirect()->route('employe.leave.view'); 
           
       
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

      $data['editData'] =employeeLeave::find($id);

      if($data['editData']==null){
        toastr()->error('Data not found');
        return redirect()->back(); 
      }
        $data['leavePurpose'] = leavePurpose::all();
        $data['employee'] = user::where('usertype','employee')->get();
        return view('backend.employee.employee_leave.employee-leave-add',$data);
    
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
            'employee_id'=>'required',
            'leave_purpose_id'=>'required',
            'start_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
            'end_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
        ],
        [
            'employee_id.required'=>'Please select employe name.',
            'leave_purpose_id.required'=>'Please select leave purpose.',
            'start_date.required'=>'Start date field cannot be empty.',
            'start_date.regex'=>'Start date field formate is invalid.',
            'end_date.required'=>'End date field cannot be empty.',
            'end_date.regex'=>'End date field formate is invalid.',
           
        ]);

           //employe validation
           if($request->employee_id){
            $userCheck = user::where('usertype','employee')->where('id',$request->employee_id)->first();
            if($userCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }

    

        //employe validation
        $getID = $request->leave_purpose_id;
        
        if($getID){
            $leave = leavePurpose::where('id',$getID)->first();

            if($leave==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }      
                
        }elseif($getID==0){
            $this->validate($request,[
                'name'=>'required|unique:leave_purposes',
            ],
            [
                'name.required'=>'Please write leave purpose.',
            ]);
        }

        if($getID==0){
            $leavePurpose = new leavePurpose();
            $leavePurpose->name  = $request->name;
            $leavePurpose->save();
            $leave_purpose_id  = $leavePurpose->id;
        }else{
            $leave_purpose_id  = $request->leave_purpose_id;
        }

        $employeeLeave  =employeeLeave::find($id);
        if($employeeLeave==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }
        $employeeLeave->employee_id = $request->employee_id;
        $employeeLeave->leave_purpose_id = $leave_purpose_id;
        $employeeLeave->start_date  = date('Y-m-d',strtotime($request->start_date));
        $employeeLeave->end_date  = date('Y-m-d',strtotime($request->end_date));
        $employeeLeave->save();

     
        toastr()->success('Data has been Update');
        return redirect()->route('employe.leave.view'); 

    }




}
