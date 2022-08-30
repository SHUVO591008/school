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

class EmployeRegControlle extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['allData'] = user::where('usertype','employee')->get();
        return view('backend.employee.employee_reg.employee-view',$data);
    }


    public function add()
    {  
        $data['designation'] = designation::all();
        return view('backend.employee.employee_reg.employee-add',$data);
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
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'fname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mname'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'mobile'=>['required','regex:/(^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8})$/'],
            'salary'=>['required','regex:/^[0-9]+$/'],
            'address'=>['required','regex:/^[a-zA-Z0-9-\/] ?([a-zA-Z0-9-\/]|[a-zA-Z0-9-\/] )*[a-zA-Z0-9-\/]$/'],
            'gender'=>'required|in:Male,Female',
            'religion'=>'required|in:hindu,christen,muslim',
            'dob'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
            'join_date'=>['required','regex:/^((0[1-9])|([12][1-9])|(3[01]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(2[0-9]{3}))$/'],
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
            'join_date.required'=>'Join Date of Birth field cannot be empty.',
            'join_date.regex'=>'Join Date of Birth field formate is invalid.',
           

        ]);

        
    
        //Disgnation validation
        if($request->designation_id){
            $designationCheck = designation::where('id',$request->designation_id)->first();
            if($designationCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }
     
   
        DB::transaction(function () use($request) {

            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = user::where('usertype','employee')->orderBy('id','DESC')->first();

            if($employee==null){
                $firstReg = 0;
                $employeeID = $firstReg + 1;
                if($employeeID<10){
                    $id_no = '000'.$employeeID;
                }elseif($employeeID<100){
                    $id_no = '00'.$employeeID;
                }elseif($employeeID<1000){
                    $id_no = '0'.$employeeID;
                }
            }else {
                $employee = user::where('usertype','employee')->orderBy('id','DESC')->first()->id;
               
                $employeeID = $employee + 1;
                if($employeeID<10){
                    $id_no = '000'.$employeeID;
                }elseif($employeeID<100){
                    $id_no = '00'.$employeeID;
                }elseif($employeeID<1000){
                    $id_no = '0'.$employeeID;
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
            $user->salary = $request->salary;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            $user->usertype = 'employee';
            $user->designation_id = $request->designation_id;

            if($request->file('image')){
                $image = $request->file('image');
                $img_name = date('YmdHi').$image->getClientOriginalName();                         
                $upld_path ='employee/employee_img/';
                $img_url =$upld_path. $img_name;
                $success =$image->move($upld_path,$img_name);
                $user->image = $img_url; 
            }
            $user->save();
            $employeesalary = new EmployeSalaryLog();
            $employeesalary->employe_id   = $user->id;
            $employeesalary->effected_date = date('Y-m-d',strtotime($request->join_date));
            $employeesalary->previous_salary = $request->salary;
            $employeesalary->present_salary = $request->salary;
            $employeesalary->incriment_salary = '0';
            $employeesalary->save();
        });

        toastr()->success('Data has been Inserted');
        return redirect()->route('employe.reg.view'); 


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
      $data['editData'] = user::find($id);

      if($data['editData']==null){
        toastr()->error('Data not found');
        return redirect()->back(); 
      }
        $data['designation'] = designation::all();
        return view('backend.employee.employee_reg.employee-add',$data);
    
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
        ]);

        //image validation
        if($request->image){
            $this->validate($request,[
            'image'=>'required|mimes:jpeg,jpg,png|max:1000',
            ]);
         }


        //Disgnation validation
        if($request->designation_id){
            $designationCheck = designation::where('id',$request->designation_id)->first();
            if($designationCheck==NULL){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
        }


            $user = user::find($id);
            if($user==null){
                toastr()->error("Sorry!not try again.");
                return redirect()->back();
            }
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->designation_id = $request->designation_id;

            if($request->file('image')){
                @unlink(public_path($user->image));
                $image = $request->file('image');
                $img_name = date('YmdHi').$image->getClientOriginalName();                         
                $upld_path ='employee/employee_img/';
                $img_url =$upld_path. $img_name;
                $success =$image->move($upld_path,$img_name);
                $user->image = $img_url; 
            }
           
            $user->save();

        toastr()->success('Data has been Update');
        return redirect()->route('employe.reg.view'); 

    }


    public function show(Request $request, $id)
    {
        $data['details'] = user::find($id);
        if($data['details']==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }

        $pdf = PDF::loadView('backend.employee.employee_reg.employee-details',$data);
        return $pdf->stream('employee-details.pdf');
 
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
