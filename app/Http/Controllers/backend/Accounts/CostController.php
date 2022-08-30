<?php

namespace App\Http\Controllers\backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\CostCategory;
use App\model\cost;

class CostController extends Controller
{
    public function index(){
        $data['allData'] = cost::orderBy('id','DESC')->get();
        $data['category'] = CostCategory::all();
        return view('backend.accounts.cost.cost-view',$data);
    }


    public function add(){
        $data['category'] = CostCategory::all();
        return view('backend.accounts.cost.cost-add',$data);
    }

    public function store(Request $request){

        $amountData = $request->amount;
        $amountReplace = str_replace( ',', '', $amountData );


        $this->validate($request,[
            'date'=>'required|date|date_format:d-m-Y',
            'category_id'=>'required|numeric',
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'amount'=>'required|regex:/^[0-9.,]+$/',
            
        ],
        [
            'date.required'=>'Date Filed cannot be empty.',
            'category_id.required'=>'Category Filed cannot be empty.',
            'category_id.numeric'=>'Category Filed Only number.',
            'name.required'=>'Category Filed cannot be empty.',
            'name.regex'=>'Name Field cannot be validated.',
            'amount.required'=>'Amount Filed cannot be empty.',
            'amount.regex'=>'Amount Filed Only number.',

           
        ]);

         

        
        $category = CostCategory::find($request->category_id);
        
       if($category==null){
        toastr()->error('Opps ! not try again');
        return back();  
       }

      $data = new cost();
      $data->expense_date = date('Y-m-d',strtotime($request->date));
      $data->category_id = $request->category_id;
      $data->name = $request->name;
      $data->amount = $amountReplace;
      $data->note = $request->note;

     
      if($request->file('image')){
        $image = $request->file('image');
        $img_name = date('YmdHi').$image->getClientOriginalName();                         
        $upld_path ='expense/expense_img/';
        $img_url =$upld_path. $img_name;
        $success =$image->move($upld_path,$img_name);
        $data->image = $img_url; 
        }
   
        $data->save();
    
        toastr()->success('Data has been Inserted');
        return redirect()->route('accounts.cost.add'); 
      
    

        
    }

    public function edit($id){
       
        $data['editData'] = cost::find($id);
        if($data['editData']==null){
            toastr()->error('Opps ! not try again');
            return back(); 
        }else{
           
            $data['category'] = CostCategory::all();
            return view('backend.accounts.cost.cost-add',$data);
            
        }

        

    }

    public function update(Request  $request,$id){


        $num1 = str_replace(',','', $request->amount);
        $finalnumber = str_replace('.00','',  $num1);

        $this->validate($request,[
            'date'=>'required|date|date_format:d-m-Y',
            'category_id'=>'required|numeric',
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/',
            'amount'=>'required|regex:/^[0-9.,]+$/',
            
        ],
        [
            'date.required'=>'Date Filed cannot be empty.',
            'category_id.required'=>'Category Filed cannot be empty.',
            'category_id.numeric'=>'Category Filed Only number.',
            'name.required'=>'Category Filed cannot be empty.',
            'name.regex'=>'Name Field cannot be validated.',
            'amount.required'=>'Amount Filed cannot be empty.',
            'amount.regex'=>'Amount Filed Only number.',

           
        ]);

        $category = CostCategory::find($request->category_id);
        $cost = cost::find($id);

        if($category==null){
            toastr()->error('Opps ! not try again');
            return back();  
        }

        if($cost==null){
            toastr()->error('Opps ! not try again');
            return back();  
        }

        $data = $cost;
        $data->expense_date = date('Y-m-d',strtotime($request->date));
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->amount = $finalnumber;
        $data->note = $request->note;

     
      if($request->file('image')){
        @unlink(public_path($data->image));
        $image = $request->file('image');
        $img_name = date('YmdHi').$image->getClientOriginalName();                         
        $upld_path ='expense/expense_img/';
        $img_url =$upld_path. $img_name;
        $success =$image->move($upld_path,$img_name);
        $data->image = $img_url; 
        }
   
        $data->update();
    
        toastr()->success('Data has been Update');
        return redirect()->route('accounts.cost.view'); 

       
    }


    public function destroy(Request $request)
    { 

        $find = cost::find($request->id);

        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }

        if(!$find->image==null){
            @unlink(public_path($find->image));
            $find->delete();
        }else{
            $find->delete();
        }

      

    }













}
