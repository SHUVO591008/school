<?php

namespace App\Http\Controllers\backend\employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use App\model\leavePurpose;
use App\model\employeeLeave;
use App\model\EmployeAttendence;
use DB;
use PDF;


class EmployeAttendencesControlle extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['allData'] = EmployeAttendence::select('date')->groupBy('date')->orderBy('date','asc')->get();
        return view('backend.employee.employee_att.employee-attendence',$data);
    }


    public function add()
    {
        $data['employee'] = user::where('usertype','employee')->get();
        return view('backend.employee.employee_att.employee-att-add',$data);
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


    $count = count($request->employee_id);
    $date = date('Y-m-d',strtotime($request->date));

    EmployeAttendence::where('date',$date)->delete();

    // $dateChack = EmployeAttendence::where('date',$date)->first();

    // if($dateChack){
    //     toastr()->error('Attendence Already Taken');
    //     return back();
    // }

    for ($i=0; $i <$count ; $i++) {

        $test = 'att_status'.$i;
        $in = 'in';
        $required = 'required';

        $this->validate($request,[
            $test => 'required|in:Present,Absent,Leave'
        ],[
            $test.'.'.$in=>'please select correct value (Present,Absent,Leave).',
            $test.'.'.$required=>'field cannot be empty.',
        ]);
    }


        $this->validate($request,[
            'date'=>['required','date'],

        ],
        [
            'date.required'=>'End date field cannot be empty.',
            'date.date'=>'End date field formate is invalid.',

        ]);


        for ($i=0; $i <$count ; $i++) {

        //employe validation
        if($request->employee_id){
            $userCheck = user::where('usertype','employee')->where('id',$request->employee_id[$i])->first();
            if($userCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }

        $att_stutas = 'att_status'.$i;
        $attend = new EmployeAttendence();
        $attend->date = date('Y-m-d',strtotime($request->date));
        $attend->employee_id = $request->employee_id[$i];
        $attend->att_stutas = $request->$att_stutas;
        $attend->save();


        }


        toastr()->success('Attendence Succesfully');
        return redirect()->route('employe.attendences.view');


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
    public function edit($date)
    {

      $data['editData'] =EmployeAttendence::where('date',$date)->get();

      $data['employee'] = user::where('usertype','employee')->get();

      if(count($data['editData'])==0){
        toastr()->error('Data not found');
        return redirect()->back();
      }


      return view('backend.employee.employee_att.employee-att-add',$data);

    }


    public function details($date){

        $data['details'] =EmployeAttendence::where('date',$date)->get();

        return view('backend.employee.employee_att.employee-att-details',$data);
    }

    public function detailsall(Request $request){

        $data['detailsall'] =EmployeAttendence::get();
        $data['user'] = EmployeAttendence::select('employee_id')->groupBy('employee_id')->get();
        $data['date'] = EmployeAttendence::select('date')->groupBy('date')->orderBy('date','asc')->get();

        return view('backend.employee.employee_att.employeAttdetails_all',$data);
    }

    public function view(Request $request){

        $data['user'] = user::where('usertype','employee')->get();

        return view('backend.employee.employee_att.attendence_view',$data);
    }

    public function get(Request $request){

        $this->validate($request,[
            'date'=>['required','date'],
            'employee_id'=>['required','numeric'],
        ],
        [
            'date.required'=>'Date field cannot be empty.',
            'date.date'=>'Date field formate is invalid.',
            'employee_id.required'=>'Employee field cannot be empty.',
            'employee_id.number'=>'Employee field formate is invalid.',
        ]);

        $date = date('Y-m',strtotime($request->date));
        $employee = $request->employee_id;

        if($employee!=''){
            $where[] = ['employee_id',$employee];
        }

        if($date!=''){
            $where[] = ['date','like',$date.'%'];
        }

        $singlAttendence = EmployeAttendence::with(['user'])->where($where)->first();

        if($singlAttendence == true){

            $data['allData'] = EmployeAttendence::with(['user'])->where($where)->get();
            $data['absent'] = EmployeAttendence::with(['user'])->where($where)->where('att_stutas','Absent')->get()->count();
            $data['Leave'] = EmployeAttendence::with(['user'])->where($where)->where('att_stutas','Leave')->get()->count();
            $data['month'] = date('M-Y',strtotime($request->date));
            $pdf = PDF::loadView('backend.employee.employee_att.attendence_pdf',$data);
            $pdf->setProtection(['copy','print'],'','pass');
            return $pdf->stream('employee-attendence.pdf');

        }else{
            toastr()->error('These Criteria Does Not Match.');
            return redirect()->back();
        }




    }




}
