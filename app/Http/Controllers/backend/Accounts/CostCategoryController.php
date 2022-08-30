<?php

namespace App\Http\Controllers\backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\CostCategory;
use App\model\cost;

class CostCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $data['allData'] = CostCategory::orderBy('id','DESC')->get();
        return view('backend.accounts.cost.cost-category-view',$data);
    }

  


    public function store(Request $request){
          
        $this->validate($request,[
            'name'=>'required|unique:cost_categories|regex:/^[a-zA-Z -.]{3,55}$/',
        ],
        [
            'name.required'=>'Expense Category Name cannot be empty.',
        ]);


        $data = new CostCategory;
        $data->name =$request->name;
        $data->save();

        toastr()->success('Data has been Inserted');
        return redirect()->back(); 
    }

    public function edit($id)
    {
        $data['editData'] = CostCategory::find($id);
        $data['allData'] = CostCategory::orderBy('id','DESC')->get();
        

        if($data['editData']==null){
            toastr()->error('Data not found');
            return redirect()->back();
        }
        
        return view('backend.accounts.cost.cost-category-view',$data);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|regex:/^[a-zA-Z -.]{3,55}$/|unique:cost_categories,name,'.$id,
        ],
        [
            'name.required'=>'Expense Category Name cannot be empty.',
        ]);


        $data = CostCategory::find($id);
        if($data==null){
            toastr()->error('Data not found');
            return redirect()->back();
        }
        $data->name = $request->name;
        $data->save();

        toastr()->success('Data has been Update');
        return redirect()->route('accounts.cost.category.view');
        


    }

    public function destroy(Request $request)
    { 

        $find = CostCategory::find($request->id);

        if($find==null){
            toastr()->error("Sorry!not try again.");
            return redirect()->back();
        }

        $cost = cost::where('category_id',$find->id)->first();

        if($cost==null){
            $find->delete();
        }else{
            $arr = array('msg' => 'Sorry!data already cost table insert!', 'status' =>false);
            return response()->json($arr);
        }

      

    }



}
