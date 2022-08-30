<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\softDelete;

class softDeleteController extends Controller
{
   public function index(){
    // $test = DB::table('costs')->where('id',3)->delete();
    // dd($test);
       $allData = softDelete::all();
       $data = softDelete::onlyTrashed()->get();
      
       return view('soft.view',compact('allData','data'));


   }

   public function store(Request $request){

    softDelete::create([
        'name' => $request->name,
        ]);

    return redirect()->back();
    
    }

    public function softDelete($id){
        $data = softDelete::find($id)->delete();
        return redirect()->back();
    }

    public function restore($id){
        $data = softDelete::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function permanently($id){

        $data = softDelete::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back();

    }

}
