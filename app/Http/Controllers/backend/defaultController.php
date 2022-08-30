<?php

namespace App\Http\Controllers\backend;

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
use App\model\assignsubject;
use App\model\cost;
use App\model\CostCategory;
use Validator;
use DB;
use PDF;
use App\District;
use App\Upazila;

class defaultController extends Controller
{
    public function getStudent(Request $request){

        $class_id = $request->class_id;
        $year_id = $request->year_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type = $request->exam_type;


        $allData = assignstudent::with(['studentData'])->where('class_id',$class_id)->where('year_id',$year_id)->get();

        $marks = marksEntry::where('assign_subject_id',$assign_subject_id)
                            ->where('class_id',$class_id)
                            ->where('exam_type_id',$exam_type)
                            ->where('year_id',$year_id)->first();

                          
        if($marks!=null){
            $arr = array('msg' => 'Marks All ready inserted!', 'status' =>false);
            return response()->json($arr);
        }
               
        if(count($allData)==null){
            $arr = array('msg' => 'Data Not Found!', 'status' =>false);
                return response()->json($arr);
            }else{
                return response()->json($allData);
               
            }

       
    }

    public function getStudentMarks(Request $request){

        $class_id = $request->class_id;
        $year_id = $request->year_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type = $request->exam_type;

         $allData = marksEntry::with(['studentData'])
                                ->where('class_id',$class_id)
                                ->where('year_id',$year_id)
                                ->where('assign_subject_id',$assign_subject_id)
                                ->where('exam_type_id',$exam_type)
                                ->get();

        if(count($allData)==null){
            $arr = array('msg' => 'Data Not Found!', 'status' =>false);
                return response()->json($arr);
            }else{
                return response()->json($allData);
                
            }
         


    }

    

    public function getSubject(Request $request){
        $class_id = $request->class_id;
        $allData = assignsubject::with(['subject'])->where('class_id',$class_id)->get();

       return response()->json($allData);
    }


    public function store(Request $request){

            $validator = Validator::make($request->all(), [
                'marks.*' => 'required|numeric',
                'student_id.*' => 'required|numeric',
    
            ]);


        
        if ($validator->passes()) {

            $class_id = $request->class_id;
            $year_id = $request->year_id;


            for ($i=0; $i <count($request->student_id) ; $i++) { 
                $marksgeter = $request->marks[$i];

                if($marksgeter>100){
                    return response()->json(['marksgeter'=>'Sorry ! Marks value not getter than 100']);
                    
                }

            }


            if($request->student_id !=null){

                for ($i=0; $i < count($request->student_id) ; $i++) { 

                    $allData = assignstudent::where('class_id',$class_id)
                                                ->where('year_id',$year_id)
                                                ->where('student_id',$request->student_id[$i])
                                                ->get();

                                              
                    $datacheck = marksEntry::where('student_id',$request->student_id[$i])
                                                ->where('year_id',$year_id)
                                                ->where('class_id',$class_id)
                                                ->where('assign_subject_id',$request->subject_id)
                                                ->where('exam_type_id',$request->exam_type_id)
                                                ->get();

                                               

                    if(count($datacheck) !=null){
   
                        return response()->json(['datacheck'=>'Data already inserted!']);
                    }                       

                    if(count($allData)==null){
                        $arr = array('wrong' => 'Data Not Found!', 'status' =>false);
                        return response()->json($arr);
                    }


                        $idNumber = user::where('id',$request->student_id[$i])->first()->id_no;  

                        $marksEntry = new marksEntry();
                        $marksEntry->student_id = $request->student_id[$i];
                        $marksEntry->id_no = $idNumber;
                        $marksEntry->year_id = $request->year_id;
                        $marksEntry->class_id = $request->class_id;
                        $marksEntry->assign_subject_id = $request->subject_id;
                        $marksEntry->exam_type_id = $request->exam_type_id;
                        $marksEntry->marks = $request->marks[$i];
                        $marksEntry->save();
  
                }
                    
               
            }else{
                return response()->json(['error'=>'somthing wrong......']);
            }

 
			
        }else{
             // return response()->json(['error'=>$validator->errors()->all()]);
            return response()->json(['error'=>'Marks Filed is required']);
        }

    	
       
        
       



    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'marks.*' => 'required|numeric',
            'student_id.*' => 'required|numeric',

        ]);


    
        if ($validator->passes()) {

            $class_id = $request->class_id;
            $year_id = $request->year_id;
            $assign_subject_id = $request->assign_subject_id;
            $exam_type = $request->exam_type;


            for ($i=0; $i <count($request->student_id) ; $i++) { 
                $marksgeter = $request->marks[$i];

                if($marksgeter>100){
                    return response()->json(['marksgeter'=>'Sorry ! Marks value not getter than 100']);
                    
                }

            }


            if($request->student_id !=null){

                for ($i=0; $i < count($request->student_id) ; $i++) { 

                    $allData = assignstudent::where('class_id',$class_id)
                                                ->where('year_id',$year_id)
                                                ->where('student_id',$request->student_id[$i])
                                                ->get();

                                            
                   

                                            

                    // if(count($datacheck) !=null){

                    //     return response()->json(['datacheck'=>'Data already inserted!']);
                    // }                       

                    if(count($allData)==null){
                        $arr = array('wrong' => 'Data Not Found!', 'status' =>false);
                        return response()->json($arr);
                    }




                        $idNumber = user::where('id',$request->student_id[$i])->first()->id_no;  

                        $marksupdate = marksEntry::where('student_id',$request->student_id[$i])
                        ->where('year_id',$year_id)
                        ->where('class_id',$class_id)
                        ->where('assign_subject_id',$request->subject_id)
                        ->where('exam_type_id',$request->exam_type_id)
                        ->first();

                     
                        $marksupdate->student_id = $request->student_id[$i];
                        $marksupdate->id_no = $idNumber;
                        $marksupdate->year_id = $request->year_id;
                        $marksupdate->class_id = $request->class_id;
                        $marksupdate->assign_subject_id = $request->subject_id;
                        $marksupdate->exam_type_id = $request->exam_type_id;
                        $marksupdate->marks = $request->marks[$i];
                        $marksupdate->update();

                }
                    
            
            }else{
                return response()->json(['error'=>'somthing wrong......']);
            }


            
        }else{
            // return response()->json(['error'=>$validator->errors()->all()]);
            return response()->json(['error'=>'Marks Filed is required']);
        }

        
    
        
   



    }

    
    public function costSearch(Request $request){

        $star_date = date('Y-m-d',strtotime($request->star_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $category_id = $request->category_id;

   
        if(!$category_id==null){
            $category_check = CostCategory::find($category_id);

            if($category_check==null){
                $arr = array('msg' => 'Data Not Found!', 'status' =>false);
                return response()->json($arr);
            }

            $cost = cost::with(['category'])->where('category_id',$category_id)->whereBetween('expense_date',[$star_date,$end_date])->get();
        }else{
            $cost = cost::with(['category'])->whereBetween('expense_date',[$star_date,$end_date])->get();
        }

       

        if(count($cost)==null){
            $arr = array('msg' => 'Data Not Found!', 'status' =>false);
            return response()->json($arr);
        }else{

            $html['date'] = 'Expense Date :'.date('d-M-Y',strtotime($star_date)).' TO '.date('d-M-Y',strtotime($end_date));

            $html['thsource'] = '<th>SL</th>';
            $html['thsource'] .= '<th>Category</th>';
            $html['thsource'] .= '<th>Expense Name</th>';
            $html['thsource'] .= '<th>Date</th>';
            $html['thsource'] .= '<th>Amount</th>';
            $html['thsource'] .= '<th>Note</th>';
            $html['thsource'] .= '<th style="width: 10%">Image</th>';
            $html['thsource'] .= '<th>Action</th>';

        
    
            foreach ($cost as $key => $v) {

                if($v['image']==null){
                    $image = url('profile/No-image-found.jpg');
                }else{
                    $image = url($v['image']);
                }

                
                
                $date = date('d-M-Y',strtotime($v['expense_date']));
                $amountformat = number_format($v['amount'],2);

                if(!$category_id==null){
                    $cost = cost::where('category_id',$category_id)->whereBetween('expense_date',[$star_date,$end_date])->get();
                }else{
                    $cost = cost::whereBetween('expense_date',[$star_date,$end_date])->get();
                }

                
                $sum = number_format($cost->sum('amount'),2);



                $color = 'info';
                $color1 = 'danger';
                $tk = ' TK';
                

                $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['category']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$date.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$amountformat.$tk.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['note'].'</td>';
                $html[$key]['tdsource'] .= '<td>';
                $html[$key]['tdsource'] .= '<img width="80%" src="'.$image.'">';
                $html[$key]['tdsource'] .='</td>';
                $html[$key]['tdsource'] .= '<td>';
                $html[$key]['tdsource'] .= '<a class="btn btn-'.$color.'" title="Edit" href="'.route("accounts.cost.edit",$v->id).'"><i class="fa fa-edit"></i></a> <a title="Delete" style="background-color: #c0ff05" class="btn btn-success delete" href="" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>';

                $html[$key]['tdsource'] .='</td>';

               

            }
            $html[$key]['tdfooter'] = '<td  rowspan="1" colspan="4"></td>';
            $html[$key]['tdfooter'] .= '<td><strong>'.'Total :'.$sum.$tk.'</strong></td>';
            $html[$key]['tdfooter'] .= '<td colspan="3"></td>';

        

            return response()->json(@$html);
            
        }


    }

    public function costReset(Request $request){

        return redirect()->route('accounts.cost.view'); 
        
    }

    public function getDistrictName(Request $request){

        
        $division_id = $request->division_id;

        $allData = District::where('division_id',$division_id)->select('name')->get();

        return response()->json($allData);


    }

    public function getUpazilatName(Request $request){

        
        $district_id = $request->district_id;

        $allData = upazila::where('district_id',$district_id)->select('name')->get();

        return response()->json($allData);


       
    }


    public function getDistrict(Request $request){

        
        $division_id = $request->division_id;

        $allData = District::where('division_id',$division_id)->get();

        return response()->json($allData);



       
    }



    public function getUpazila(Request $request){

        
        $district_id = $request->district_id;

        $allData = Upazila::where('district_id',$district_id)->get();

        return response()->json($allData);



       
    }

    



}
