<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\assignstudent;
use App\model\discountstudent;
use App\user;
use App\model\studentGroup;
use App\model\studentShift;
use App\model\studentYear;
use App\model\studentClass;
use DB;
use PDF;

class StudentRegController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['data'] = assignstudent::all();

        


        $data['year'] = studentYear::orderBy('id', 'DESC')->get();
        $data['class'] = studentClass::all();

        return view('backend.student.student_reg.student-view',$data);
    }


    public function add()
    {
        $data['group'] = studentGroup::all();
        $data['shift'] = studentShift::all();
        $data['year'] = studentYear::orderBy('id', 'DESC')->get();
        $data['class'] = studentClass::all();

        return view('backend.student.student_reg.student-add',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data['year'] = studentYear::all();
        $data['class'] = studentClass::all();

        if($request->class_id==01 && $request->year_id==01){
            $data['assignstudent'] = assignstudent::all();
            return view('backend.student.student_reg.student-view',$data);
        }

        $data['assignstudent'] = assignstudent::where('class_id',$request->class_id)->where('year_id',$request->year_id)->get();

        if(count($data['assignstudent'])==null){
            toastr()->error('Data not found!');
            return redirect()->back();
        }else{
            return view('backend.student.student_reg.student-view',$data);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {


        $this->validate($request,[
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'fname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mobile'=>['required','regex:/(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$/'],
            'address'=>['required','regex:/^[a-zA-Z0-9-\/] ?([a-zA-Z0-9-\/]|[a-zA-Z0-9-\/] )*[a-zA-Z0-9-\/]$/'],
            'gender'=>'required|in:Male,Female',
            'religion'=>'required|in:hindu,christen,muslim',
            'dob'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
            'class_id'=>'required',
            'year_id'=>'required',
            'shift_id'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png|max:1000',


        ],
        [
            'name.required'=>'Student Name cannot be empty.',
            'name.regex'=>'Student Name formate is invalid.',
            'fname.required'=>'Father Name cannot be empty.',
            'fname.regex'=>'Father Name formate is invalid.',
            'mname.required'=>'Mother Name cannot be empty.',
            'mname.regex'=>'Mother Name formate is invalid.',
            'mobile.required'=>'Mobile Name cannot be empty.',
            'mobile.regex'=>'Mobile Name formate is invalid.',
            'address.required'=>'Address Name cannot be empty.',
            'address.regex'=>'Address Name formate is invalid.',
            'gender.required'=>'Gender field cannot be empty.',
            'gender.in'=>'Gender field formate is invalid.',
            'religion.required'=>'Religion field cannot be empty.',
            'religion.in'=>'Religion field formate is invalid.',
            'dob.required'=>'Date of Birth field cannot be empty.',
            'dob.regex'=>'Date of Birth field formate is invalid.',
            'class_id.required'=>'Class field cannot be empty.',
            'year_id.required'=>'Year field cannot be empty.',
            'shift_id.required'=>'shift field cannot be empty.',

        ]);

        //discount validation
        if($request->discount){
            $this->validate($request,[
             'discount'=>['regex:/^([0-9]|([1-9][0-9])|100)$/'],
            ]);
         }

        //class validation
        if($request->class_id){
            $classCheck = studentClass::where('id',$request->class_id)->first();
            if($classCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //Year validation
         if($request->year_id){
            $yearCheck = studentYear::where('id',$request->year_id)->first();
            if($yearCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
        //group validation
        if($request->group_id){
            $groupCheck = studentGroup::where('id',$request->group_id)->first();
            if($groupCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //shift validation
         if($request->shift_id){
            $shiftCheck = studentShift::where('id',$request->shift_id)->first();
            if($shiftCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }




        DB::transaction(function () use($request) {

            $checkYear = studentYear::find($request->year_id)->name;
            $student = user::where('usertype','Student')->orderBy('id','DESC')->first();

            if($student==null){
                $firstReg = 0;
                $studentID = $firstReg + 1;
                if($studentID<10){
                    $id_no = '000'.$studentID;
                }elseif($studentID<100){
                    $id_no = '00'.$studentID;
                }elseif($studentID<1000){
                    $id_no = '0'.$studentID;
                }
            }else {
                $student = user::where('usertype','Student')->orderBy('id','DESC')->first()->id;

                $studentID = $student + 1;
                if($studentID<10){
                    $id_no = '000'.$studentID;
                }elseif($studentID<100){
                    $id_no = '00'.$studentID;
                }elseif($studentID<1000){
                    $id_no = '0'.$studentID;
                }

            }

            $user = new user();
            $code = rand('0000','9999');
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->id_no = $checkYear.$id_no;
            $user->code =  $code;
            $user->password = bcrypt($code);
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->usertype = 'Student';

            if($request->file('image')){
                $image = $request->file('image');
                $img_name = date('YmdHi').$image->getClientOriginalName();
                $upld_path ='student/student_img/';
                $img_url =$upld_path. $img_name;
                $success =$image->move($upld_path,$img_name);
                $user->image = $img_url;
            }
            $user->save();

            //assign student
            // $assignStuCount = assignstudent::where('class_id',$request->class_id)
            //             ->where('year_id',$request->year_id)
            //             ->get();

            // $count = count($assignStuCount);


            // if($count==null){
            //     $firstRoll = 0;
            //     $studentRoll = $firstRoll + 1;
            // }else {
            //     $assignStu = assignstudent::where('class_id',$request->class_id)
            //     ->where('year_id',$request->year_id)
            //     ->orderBy('id','DESC')->first()->roll;

            //     $studentRoll = $assignStu + 1;
            // }

            $assignstudent = new assignstudent();
            $assignstudent->student_id  = $user->id;
            $assignstudent->class_id = $request->class_id;
            $assignstudent->year_id = $request->year_id;
            $assignstudent->group_id = $request->group_id;
            // $assignstudent->roll = $studentRoll;
            $assignstudent->shift_id = $request->shift_id;
            $assignstudent->save();

            if($request->discount){
                $discountstudent = new discountstudent();
                $discountstudent->assign_student_id = $assignstudent->id;
                $discountstudent->discount = $request->discount;
                $discountstudent->fee_category_id = 4;
                $discountstudent->save();
            }


        });

        toastr()->success('Data has been Inserted');
        return redirect()->route('student.reg.view');


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

        $data['editData'] = assignstudent::where('id',$id)->first();

        if($data['editData']==null){
            return back();
        }

        $data['group'] = studentGroup::all();
        $data['shift'] = studentShift::all();
        $data['year'] = studentYear::orderBy('id','DESC')->get();
        $data['class'] = studentClass::all();

        return view('backend.student.student_reg.student-add',$data);


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
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'fname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mobile'=>['required','regex:/(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$/'],
            'address'=>['required','regex:/^[a-zA-Z0-9-\/] ?([a-zA-Z0-9-\/]|[a-zA-Z0-9-\/] )*[a-zA-Z0-9-\/]$/'],
            'gender'=>'required|in:Male,Female',
            'religion'=>'required|in:hindu,christen,muslim',
            'dob'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
            'class_id'=>'required',
            'year_id'=>'required',
            'shift_id'=>'required',



        ],
        [
            'name.required'=>'Student Name cannot be empty.',
            'name.regex'=>'Student Name formate is invalid.',
            'fname.required'=>'Father Name cannot be empty.',
            'fname.regex'=>'Father Name formate is invalid.',
            'mname.required'=>'Mother Name cannot be empty.',
            'mname.regex'=>'Mother Name formate is invalid.',
            'mobile.required'=>'Mobile Name cannot be empty.',
            'mobile.regex'=>'Mobile Name formate is invalid.',
            'address.required'=>'Address Name cannot be empty.',
            'address.regex'=>'Address Name formate is invalid.',
            'gender.required'=>'Gender field cannot be empty.',
            'gender.in'=>'Gender field formate is invalid.',
            'religion.required'=>'Religion field cannot be empty.',
            'religion.in'=>'Religion field formate is invalid.',
            'dob.required'=>'Date of Birth field cannot be empty.',
            'dob.regex'=>'Date of Birth field formate is invalid.',
            'class_id.required'=>'Class field cannot be empty.',
            'year_id.required'=>'Year field cannot be empty.',
            'shift_id.required'=>'shift field cannot be empty.',

        ]);

        //image validation
        if($request->image){
            $this->validate($request,[
            'image'=>'required|mimes:jpeg,jpg,png|max:1000',
            ]);
         }

        //discount validation
        if($request->discount){
            $this->validate($request,[
             'discount'=>['regex:/^([0-9]|([1-9][0-9])|100)$/'],
            ]);
         }

        //class validation
        if($request->class_id){
            $classCheck = studentClass::where('id',$request->class_id)->first();
            if($classCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //Year validation
         if($request->year_id){
            $yearCheck = studentYear::where('id',$request->year_id)->first();
            if($yearCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
        //group validation
        if($request->group_id){
            $groupCheck = studentGroup::where('id',$request->group_id)->first();
            if($groupCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //shift validation
         if($request->shift_id){
            $shiftCheck = studentShift::where('id',$request->shift_id)->first();
            if($shiftCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }


         //assign validation

         $studentId = assignstudent::where('id',$id)->first()->student_id;

         $ID = assignstudent::where('id',$id)->first()->id;


         $valid = assignstudent::where('student_id',$studentId)
                                        ->where('class_id',$request->class_id)
                                        ->where('year_id',$request->year_id)
                                        ->first();

        if($valid==null){
            $studentClassCheck = assignstudent::where('student_id',$studentId)->first()->class_id;
            $studentYearCheck = assignstudent::where('student_id',$studentId)->first()->year_id;

            if($studentClassCheck==$request->class_id){
                toastr()->error("Sorry! Please change the class");
                return redirect()->back();
            }else{
                if($studentYearCheck==$request->year_id){
                    toastr()->error("Sorry! Please change the year");
                    return redirect()->back();
                }
            }

            $finalYearCheck = assignstudent::where('student_id',$studentId)->where('year_id',$request->year_id)->get();
            $yearCount = count($finalYearCheck);

            $finalYearClass = assignstudent::where('student_id',$studentId)->where('class_id',$request->class_id)->get();
            $classCount = count($finalYearClass);


            if($yearCount>0){
                toastr()->error("Sorry! This year already insert");
                return redirect()->back();
            }elseif($classCount>0){
                toastr()->error("Sorry! This class already insert");
                return redirect()->back();
            }

        }else{

            $ClassCheck = assignstudent::where('student_id',$studentId)
            ->where('class_id',$request->class_id)
            ->where('year_id',$request->year_id)
            ->first()->id;

            if($ClassCheck !== $ID){
                $finalClassCheck = assignstudent::where('student_id',$studentId)
                ->where('class_id',$request->class_id)
                ->where('year_id',$request->year_id)
                ->get();

                $count =count($finalClassCheck);
                if($count>0){
                toastr()->error("Sorry! Please change the Class or Year");
                return redirect()->back();
                }
            }

        }


        DB::transaction(function () use($request,$studentId) {
            $user =User::where('id',$studentId)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->usertype = 'Student';

            if($request->file('image')){
                @unlink(public_path($user->image));
                $image = $request->file('image');
                $img_name = date('YmdHi').$image->getClientOriginalName();
                $upld_path ='student/student_img/';
                $img_url =$upld_path. $img_name;
                $success =$image->move($upld_path,$img_name);
                $user->image = $img_url;
            }
            $user->save();



            $assignstudent = assignstudent::where('student_id',$studentId)
                                        ->where('class_id',$request->class_id)
                                        ->where('year_id',$request->year_id)
                                        ->first();
             if($assignstudent==null){
                $assignstudent = new assignstudent();
                $assignstudent->student_id  = $user->id;
                $assignstudent->class_id = $request->class_id;
                $assignstudent->year_id = $request->year_id;
                $assignstudent->group_id = $request->group_id;
                $assignstudent->shift_id = $request->shift_id;
                $assignstudent->save();
             }
            $assignstudent->class_id = $request->class_id;
            $assignstudent->year_id = $request->year_id;
            $assignstudent->group_id = $request->group_id;
            $assignstudent->shift_id = $request->shift_id;
            $assignstudent->update();

            if($request->discount){
                $discountstudent = discountstudent::where('assign_student_id',$assignstudent->id)
                                                    ->where('class_id',$request->class_id)
                                                    ->where('year_id',$request->year_id)
                                                    ->first();

                if($discountstudent==null){
                    $discountstudent = new discountstudent();
                    $discountstudent->assign_student_id = $assignstudent->id;
                    $discountstudent->discount = $request->discount;
                    $discountstudent->class_id = $request->class_id;
                    $discountstudent->year_id = $request->year_id;
                    $discountstudent->fee_category_id = 4;
                    $discountstudent->save();
                }
                $discountstudent->assign_student_id = $assignstudent->id;
                $discountstudent->discount = $request->discount;
                $discountstudent->class_id = $request->class_id;
                $discountstudent->year_id = $request->year_id;
                $discountstudent->fee_category_id = 4;
                $discountstudent->update();
            }


        });

        toastr()->success('Data has been Update');
        return redirect()->route('student.reg.view');



    }

    public function promotion($id)
    {


        $data['editData'] = assignstudent::where('id',$id)->first();


        if($data['editData']==null){
            return back();
        }

        $data['group'] = studentGroup::all();
        $data['shift'] = studentShift::all();
        $data['year'] = studentYear::orderBy('id', 'DESC')->get();
        $data['class'] = studentClass::all();

        return view('backend.student.student_reg.student-promotion',$data);

    }


    public function promotionstore(Request $request, $id)
    {
        $studentId = assignstudent::where('id',$id)->first()->student_id;

        $finalClassCheck = assignstudent::where('student_id',$studentId)
                                        ->where('class_id',$request->class_id)
                                        ->where('year_id',$request->year_id)
                                        ->get();



         $count =count($finalClassCheck);

        if($count>0){
            toastr()->error("Sorry! Please change the Class or Year");
            return redirect()->back();
        }


        $studentClassCheck = assignstudent::where('student_id',$studentId)->first()->class_id;
        $studentYearCheck = assignstudent::where('student_id',$studentId)->first()->year_id;



        if($studentClassCheck==$request->class_id){
            toastr()->error("Sorry! Please change the class");
            return redirect()->back();
        }else{
            if($studentYearCheck==$request->year_id){
                toastr()->error("Sorry! Please change the year");
                return redirect()->back();
            }
        }

        $finalYearCheck = assignstudent::where('student_id',$studentId)->where('year_id',$request->year_id)->get();
        $yearCount = count($finalYearCheck);

        $finalYearClass = assignstudent::where('student_id',$studentId)->where('class_id',$request->class_id)->get();
        $classCount = count($finalYearClass);


        if($yearCount>0){
            toastr()->error("Sorry! This year already insert");
            return redirect()->back();
        }elseif($classCount>0){
            toastr()->error("Sorry! This class already insert");
            return redirect()->back();
        }




        $this->validate($request,[
            'class_id'=>'required',
            'year_id'=>'required',
            'shift_id'=>'required',
        ],
        [
            'class_id.required'=>'Class field cannot be empty.',
            'year_id.required'=>'Year field cannot be empty.',
            'shift_id.required'=>'shift field cannot be empty.',

        ]);

        //discount validation
        if($request->discount){
            $this->validate($request,[
             'discount'=>['regex:/^([0-9]|([1-9][0-9])|100)$/'],
            ]);
         }

        //class validation
        if($request->class_id){
            $classCheck = studentClass::where('id',$request->class_id)->first();
            if($classCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //Year validation
         if($request->year_id){
            $yearCheck = studentYear::where('id',$request->year_id)->first();
            if($yearCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
        //group validation
        if($request->group_id){
            $groupCheck = studentGroup::where('id',$request->group_id)->first();
            if($groupCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
         //shift validation
         if($request->shift_id){
            $shiftCheck = studentShift::where('id',$request->shift_id)->first();
            if($shiftCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }


        DB::transaction(function () use($request,$studentId) {

            $assignstudent = new assignstudent();
            $assignstudent->student_id  = $studentId;
            $assignstudent->class_id = $request->class_id;
            $assignstudent->year_id = $request->year_id;
            $assignstudent->group_id = $request->group_id;
            $assignstudent->shift_id = $request->shift_id;
            $assignstudent->save();

            if($request->discount){
                $discountstudent = new discountstudent();
                $discountstudent->assign_student_id = $assignstudent->id;
                $discountstudent->class_id = $request->class_id;
                $discountstudent->year_id = $request->year_id;
                $discountstudent->discount = $request->discount;
                $discountstudent->fee_category_id = 4;
                $discountstudent->save();
            }


        });

        toastr()->success('Student promotion Successfully ');
        return redirect()->route('student.reg.view');




    }

    public function details(Request $request, $id)
    {
        $data['details'] = assignstudent::where('id',$id)->first();
        $pdf = PDF::loadView('backend.student.student_reg.student-details',$data);
        return $pdf->stream('student_details.pdf');

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
