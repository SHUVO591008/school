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
use DB;
use PDF;

class marksController extends Controller
{
    public function add(){
        $data['class'] = studentClass::all();
        $data['year'] = studentYear::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.student-marks-entry',$data);
    }

    public function edit(){
        $data['class'] = studentClass::all();
        $data['year'] = studentYear::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.student-marks-edit',$data);
    }

    
}
