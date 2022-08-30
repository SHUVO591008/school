<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use DB;
use App\model\studentFeeCategory;
use App\model\studentClass;
use App\model\studentFeeAmount;
use Validator;

class studentFeeAmountController extends Controller
{
    public function index()
    {
        $data = studentFeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();

        return view('backend.studentFeeAmount.studentFeeAmount',compact('data'));
    }

    public function add()
    {
        $data['fee_category'] = studentFeeCategory::all();
        $data['class'] = studentClass::all();
        return view('backend.studentFeeAmount.addFeeAmount',$data);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'fee_category_id'=>'required',
            'class_id.*'=>'required',
            'amount.*'=>'required|numeric',  
        ],
        [
            'fee_category_id.required'=>'Please Select The Fee Category.',
            'class_id.*.required'=>'Please Select The class.',
            'amount.*.required'=>'Please Enter the amount.',
            'amount.*.numeric'=>'The field must be number.',
            
        ]);

         //fee category check   
        $FeeCategoryDataCheck = studentFeeCategory::where('id',$request->fee_category_id)->first();
        if($FeeCategoryDataCheck==null){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }

        
        foreach ($request->class_id as $key => $value) {

            //class id check
            $StudentClassDataCheck = studentClass::where('id',$request->class_id[$key])->first();
            if($StudentClassDataCheck==null){
             toastr()->error("Opps!Please don't try this way.");
             return redirect()->back(); 
            }

            //data insert 1st way
            // $data = array(
            //     'fee_category_id'=>$request->fee_category_id,
            //     'class_id'=>$request->class_id[$key],
            //     'amount'=>$request->amount[$key],
            // );

            // $insert = DB::table('student_fee_amounts')->insert($data);   
            
        }

        //data insert 2nd way
        $count = count($request->class_id);
        for ($i=0; $i <$count ; $i++) { 

            $data = new studentFeeAmount();
            $data->fee_category_id = $request->fee_category_id;
            $data->class_id = $request->class_id[$i];
            $data->amount = $request->amount[$i];
            $save = $data->save();
        }

        if($save){
            toastr()->success('Data has been Inserted');
            return redirect()->route('students.fee.amount.view'); 
        }else{
            toastr()->error('Data has been not Inserted');
            return redirect()->back(); 
        }
               


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
    public function edit($fee_category_id)
    {

        $data['editData'] = studentFeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_category'] = studentFeeCategory::all();
        $data['class'] = studentClass::all();

       $count = count($data['editData']);

        if($count==0){
            toastr()->error('Data not Found!');
            return back(); 
        }

        return view('backend.studentFeeAmount.editFeeAmount',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_category_id)
    {

        if($request->class_id==NULL){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }
       

        $this->validate($request,[
            'fee_category_id'=>'required',
            'class_id.*'=>'required',
            'amount.*'=>'required',  
        ],
        [
            'fee_category_id.required'=>'Please Select The Fee Category.',
            'class_id.*.required'=>'Please Select The class.',
            'amount.*.required'=>'Please Enter the amount.',
            
        ]);

         //fee category check   
        $FeeCategoryDataCheck = studentFeeCategory::where('id',$request->fee_category_id)->first();
        if($FeeCategoryDataCheck==null){
            toastr()->error("Opps!Please don't try this way.");
            return redirect()->back(); 
        }

        
        foreach ($request->class_id as $key => $value) {

            //class id check
            $StudentClassDataCheck = studentClass::where('id',$request->class_id[$key])->first();
            if($StudentClassDataCheck==null){
             toastr()->error("Opps!Please don't try this way.");
             return redirect()->back(); 
            }

        }

        //data insert
        studentFeeAmount::where('fee_category_id',$fee_category_id)->delete();
        $count = count($request->class_id);
        for ($i=0; $i <$count ; $i++) { 
            $data = new studentFeeAmount();
            $data->fee_category_id = $request->fee_category_id;
            $data->class_id = $request->class_id[$i];
            $data->amount = $request->amount[$i];
            $save = $data->save();
        }

        if($save){
            toastr()->success('Data has been Update');
            return redirect()->route('students.fee.amount.view'); 
        }else{
            toastr()->error('Data has been not Update');
            return redirect()->back(); 
        }
               

    }

    public function view(Request $request, $fee_category_id){

        $find = studentFeeAmount::where('fee_category_id',$fee_category_id)->first();

      if($find==null){
        toastr()->error("Opps!Please don't try this way.");
        return redirect()->back(); 
      }
        
        $data['view'] = studentFeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.studentFeeAmount.detailsFeeAmount',$data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // { 
    //     $find = studentFeeCategory::find($request->id);
    //     if($find==null){
    //         toastr()->error("Sorry!not try again.");
    //         return redirect()->back();
    //     }
       
    //     $find->delete();

    // }
}
