<?php

namespace App\Http\Controllers\backend\marksheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\marksEntry;
use App\model\ExamType;
use App\model\MarksGrade;
use App\model\studentClass;
use App\model\studentYear;
use App\model\assignstudent;
use PDF;

class marksheetController extends Controller
{

    public function index(Request $request){
        $data['years'] = studentYear::all();
        $data['class'] = studentClass::all();
        $data['ExamType'] = ExamType::all();

        return view('backend.markssheet.student-marks-view',$data);

    }

    public function get(Request $request){

        $this->validate($request,[
            'class' =>'required|numeric',
            'year' =>'required|numeric',
            'exam_type' =>'required|numeric',
            'id_no' =>'required|numeric',
        ]);

        $class_id = $request->class;
        $year_id = $request->year;
        $exam_type = $request->exam_type;
        $id_no = $request->id_no;



        $count_fail = marksEntry::where('id_no',$id_no)->where('year_id',$year_id)
                                ->where('class_id',$class_id)->where('exam_type_id',$exam_type)
                                ->where('marks','<','33')->get()->count();

        $single_student = marksEntry::where('id_no',$id_no)->where('year_id',$year_id)
                                    ->where('class_id',$class_id)->where('exam_type_id',$exam_type)->first();



        if ($single_student == true){

            $assign_student = assignstudent::where('year_id',$single_student->year_id)
                ->where('class_id',$single_student->class_id)
                ->where('student_id',$single_student->student_id)
                ->first();

            if($assign_student!==null) {

                $allMarks = marksEntry::with(['assign_subject', 'year'])->where('id_no', $id_no)
                    ->where('year_id', $year_id)
                    ->where('class_id', $class_id)->where('exam_type_id', $exam_type)->get();

                $allGrade = MarksGrade::all();

                return view('backend.markssheet.student-marks-print', compact('allMarks', 'allGrade', 'count_fail'));
            }else{
                toastr()->error('Data Not Found');
                return redirect()->back();

            }

        }else{
            toastr()->error('Data Not Found');
            return redirect()->back();
        }

    }


    public function allmarksheet(Request $request){
        $data['years'] = studentYear::all();
        $data['class'] = studentClass::all();
        $data['ExamType'] = ExamType::all();

        return view('backend.markssheet.all-student-marks-view',$data);

    }



    public function allmarksheetget(Request $request){

        $this->validate($request,[
            'class' =>'required|numeric',
            'year' =>'required|numeric',
            'exam_type' =>'required|numeric',
        ]);

        $class_id = $request->class;
        $year_id = $request->year;
        $exam_type = $request->exam_type;




        $single_student = marksEntry::where('year_id',$year_id)
                                    ->where('class_id',$class_id)
                                    ->where('exam_type_id',$exam_type)->first();


        if($single_student == true){

            $assign_student = assignstudent::where('year_id',$single_student->year_id)
                ->where('class_id',$single_student->class_id)
                ->where('student_id',$single_student->student_id)
                ->first();



            if($assign_student!==null) {

                $data['allMarks'] = marksEntry::select('year_id','class_id','exam_type_id','student_id')
                                                ->where('year_id', $year_id)
                                                ->where('class_id', $class_id)
                                                ->where('exam_type_id',$exam_type)
                                                ->groupBy('class_id')
                                                ->groupBy('year_id')
                                                ->groupBy('student_id')
                                                ->groupBy('exam_type_id')
                                                ->get();

//                                                 dd($data['allMarks']);





                $pdf = PDF::loadView('backend.markssheet.all-student-marks-pdf',$data);
                $pdf->setProtection(['copy','print'],'','pass');
                return $pdf->stream('all-student-marksheet.pdf');


            }else{
                toastr()->error('Data Not Found');
                return redirect()->back();

            }

        }else{
            toastr()->error('Sorry!These Criteria does not match!');
            return redirect()->back();
        }

    }



}
