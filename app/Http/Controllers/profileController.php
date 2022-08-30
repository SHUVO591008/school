<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\user;
use DB;

class profileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authid = Auth::user()->id;
        $user = User::find($authid);


        return view('profile.view',compact('user'));


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
        $this->validate($request,[
            'name'=>'required|min:3|max:55',
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile'=>'min:11|numeric',
            'address'=>'required|min:6|',
            'gender'=>'required||in:Male,Female|not_in:Select Gender',
            'image' => 'image|mimes:jpeg,jpg,png',

        ],
        [
            'name.required'=>'Name cannot be empty.',
            'name.min'=>'Name minimum:3 characters.',
            'name.max'=>'Name Not be greater then 55 characters..',
            'email.required'=>'Email cannot be empty.',
            'mobile.min'=>'Mobile Number must be 11 characters.',
            'mobile.numeric'=>'Mobile Number must be Numeric.',
            'address.required'=>'Address cannot be empty.',
            'address.min'=>'Address must be 11 characters.',
            'image.image'=>'Must be image.',
            'image.mimes'=>'JPG or PNG.',

        ]);


            $userid = Auth::user()->id;
            $data = array();
           $data['name']=$request->name;
           $data['email']=$request->email;
           $data['mobile']=$request->mobile;
           $data['address']=$request->address;
           $data['gender']=$request->gender;

           $image =$request->file('image');



        //if image here...
         if($image){

            $img_name = rand();
            $text =strtolower($image->getClientOriginalExtension());

            $img_full_name = $img_name.'.'.$text;
            $upld_path ='profile/user_image/';
            $img_url =$upld_path. $img_full_name;
            $success =$image->move($upld_path,$img_full_name);


             //if imgage success
            if($success){

                //if imgage not include
                $img =DB::table('users')
                                ->where('id',$userid)
                                ->first();

                if($img->image){

                    $data['image']=$img_url;
                    $img =DB::table('users')
                                ->where('id',$userid)
                                ->first();

                    $img_path = $img->image;

                    $done= unlink($img_path);
                    $user =DB::table('users')
                            ->where('id',$userid)
                            ->update($data);

                    if($user){
                     toastr()->success('Data Update Successfuly');
                             return back();
                        } else{
                            toastr()->error('error Message');
                            return back();
                        }

                }else{

                    $data['image']=$img_url;
                    $user =  $img =DB::table('users')
                            ->where('id',$userid)
                            ->update($data);

                     if($user){

                         toastr()->success('Data Update Successfuly');
                         return back();
                    } else{
                         toastr()->error('error Message');
                            return back();
                    }

                }

                //if imgage not include End


            }else{

                toastr()->error('error Message');
                return back();
            }

        //if imgage success End

         }else{
            $old = $request->old_photo;
            $data['image']=$old;

            $user =  $img =DB::table('users')
                    ->where('id',$userid)
                    ->update($data);

            if($user){

            toastr()->success('Data Update Successfuly');
            return back();

            }else{

                toastr()->error('error Message');
                return back();
            }

            }
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
