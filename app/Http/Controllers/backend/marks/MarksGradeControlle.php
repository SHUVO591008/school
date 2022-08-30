<?php

namespace App\Http\Controllers\backend\marks;

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
use App\model\marksEntry;
use App\model\ExamType;
use App\model\MarksGrade;
use DB;
use PDF;

class MarksGradeControlle extends Controller
{
    public function index(){
        $data['allData'] = MarksGrade::all();
        return view('backend.marks.student-grade-point',$data);
    }


    public function add(){
        return view('backend.marks.student-grade-point-add');
    }

    public function store(Request $request){

        $this->validate($request,[
            'grade_name' =>'required',
            'grade_point' =>'required|numeric',
            'start_mark' =>'required|numeric',
            'end_mark' =>'required|numeric',
            'start_point' =>'required|numeric',
            'end_point' =>'required|numeric',
            'remarks' =>'required',
        ],
        [
            'grade_name.required'=>'Grade Name cannot be empty.',


            'grade_point.required'=>'Grade Point cannot be empty.',
            'grade_point.numeric'=>'Grade Point Only number',

           
        ]);


        $MarksGrade = new MarksGrade();
        $MarksGrade->grade_name = $request->grade_name;
        $MarksGrade->grade_point = $request->grade_point;
        $MarksGrade->start_mark = $request->start_mark;
        $MarksGrade->end_mark = $request->end_mark;
        $MarksGrade->start_point = $request->start_point;
        $MarksGrade->end_point = $request->end_point;
        $MarksGrade->remarks = $request->remarks;
        $MarksGrade->save();

        toastr()->success('Data has been Inserted');
        return redirect()->route('marks.grade.view'); 



    }

    public function edit($id){
        $data['editData'] = MarksGrade::find($id);
        if($data['editData']==null){
            return back(); 
        }

        return view('backend.marks.student-grade-point-add',$data);


    }


    public function update(Request $request, $id){


        $this->validate($request,[
            'grade_name' =>'required',
            'grade_point' =>'required|numeric',
            'start_mark' =>'required|numeric',
            'end_mark' =>'required|numeric',
            'start_point' =>'required|numeric',
            'end_point' =>'required|numeric',
            'remarks' =>'required',
        ],
        [
            'grade_name.required'=>'Grade Name cannot be empty.',


            'grade_point.required'=>'Grade Point cannot be empty.',
            'grade_point.numeric'=>'Grade Point Only number',

           
        ]);


        $data = MarksGrade::find($id);
        if($data==null){
            return back(); 
        }

        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark = $request->start_mark;
        $data->end_mark = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->update();
 
        toastr()->success('Data has been Update');
        return redirect()->route('marks.grade.view'); 
       

    }


}
