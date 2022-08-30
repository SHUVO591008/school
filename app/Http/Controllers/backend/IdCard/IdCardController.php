<?php

namespace App\Http\Controllers\backend\IdCard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\ExamType;
use App\model\studentClass;
use App\model\studentYear;
use App\model\assignstudent;

use PDF;

class IdCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request()->userAgent());
        // dd(request()->ip());
    
      
        $data['years'] = studentYear::all();
        $data['class'] = studentClass::all();

        return view('backend.IdCard.IdCard-view',$data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request,[
            'class' =>'required|numeric',
            'year' =>'required|numeric',
        ]);

        $class_id = $request->class;
        $year_id = $request->year;
        $check_data = assignstudent::where('year_id',$year_id)
                                    ->where('class_id',$class_id)
                                    ->first();
        if($check_data == true){

                $data['AllId'] = assignstudent::where('year_id', $year_id)
                                                ->where('class_id', $class_id)
                                                ->get();


                $pdf = PDF::loadView('backend.IdCard.all-student-IdCard-pdf',$data);
                $pdf->setProtection(['copy','print'],'','pass');
                return $pdf->stream('all-student-IDCard.pdf');

        }else{
            toastr()->error('Sorry!These Criteria does not match!');
            return redirect()->back();
        }

    

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
