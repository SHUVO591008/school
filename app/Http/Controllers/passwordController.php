<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\user;

class passwordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('password_change.password');
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
           
            'old_pwd' => 'required',
            'password' => 'min:6',
            'cnfrmpassword' => 'required_with:password|same:password|min:6'

        ],
        [
            
            'old_pwd.required'=>'Password cannot be empty.',
            'password.min'=>'password minimum 6 characters.',
            'cnfrmpassword.min'=>'Confirm password minimum 6 characters.',
            'cnfrmpassword.same'=>'Password & Confirm password does not match.',
            'cnfrmpassword.required_with'=>'confirm Password cannot be empty.',
            
        ]);

            if(Auth::attempt(['id' =>Auth::user()->id, 'password' => $request->old_pwd])){
                        $user = user::find(Auth::user()->id);
                       $user->password =bcrypt($request->password);
                       $user->code =Null;
                       $user->save();

            toastr()->success(" Your Password Successfuly Change!");
               return redirect()->route('profile.view');

            }else{
                toastr()->error("Sorry! Your Old Password doesn't match!");
               return redirect()->back()->withInput();
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
