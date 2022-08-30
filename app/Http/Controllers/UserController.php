<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use Crypt;
use Stevebauman\Location\Facades\Location;



class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $user = User::where('usertype','Admin')->where('status','1')->get();
       // $ip= $_SERVER['REMOTE_ADDR'];
  
       
       
        $ip = '103.113.172.162'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
        
    
      
    
   
        return view('user.userView',compact('user','currentUserInfo'));


    }

    



    public function Useradd()
    {
        return view('user.adduser');
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
            'role'=>'required|in:Admin,Operator|not_in:Select Role',
            'name'=>'required|min:3|max:55',
            'email'=>'required|unique:users',
            // 'password' => 'min:6',
            // 'cnfrmpassword' => 'required_with:password|same:password|min:6'

        ],
        [
            'role.required'=>'Role name cannot be empty.',
            'role.not_in'=>'Plesse Select the Role.',
            'name.required'=>'Name cannot be empty.',
           
            'name.min'=>'Name minimum:3 characters.',
            'name.max'=>'Name Not be greater then 55 characters..',
            'email.required'=>'Email cannot be empty.',
            // 'password.required'=>'Password cannot be empty.',
            // 'password.min'=>'password minimum 6 characters.',
            // 'cnfrmpassword.min'=>'Confirm password minimum 6 characters.',
            // 'cnfrmpassword.same'=>'Password & Confirm password does not match.',
        ]);

        

        $code = rand(0000,9999);
       $data = new User();
       $data->usertype = 'Admin';
       $data->role = $request->role;
       $data->name = $request->name;
       $data->email = $request->email;
       $data->status = '1';
       $data->code = $code;
       $data->password =bcrypt($code );
       $users = $data->save();

       if($users){
            toastr()->success('Data has been Inserted');
            return redirect()->route('users.view'); 
        }else{
            toastr()->error('Data has been not Inserted');
            return back();  
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
        // $user = User::find($id);
        $decrypted = Crypt::decrypt($id);
        $user = User::findOrFail($decrypted);

        return view('user.singleuser',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userfind = User::find($id);
        
        return view('user.edituser',compact('userfind'));
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
            'role'=>'required|in:Admin,Operator|not_in:Select Role',
            'name'=>'required|min:3|max:55',
            'email'=>'required|email|unique:users,email,'.$id,
            
        ],
        [
            'role.required'=>'Role name cannot be empty.',
            'role.not_in'=>'Plesse Select the Role.',
            'name.required'=>'Name cannot be empty.',
        
            'name.min'=>'Name minimum:3 characters.',
            'name.max'=>'Name Not be greater then 55 characters..',
            'email.required'=>'Email cannot be empty.',
           
        ]);


        $data = User::find($id);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $users = $data->save();

       if($users){
            toastr()->success('Data has been Update');
            return redirect()->route('users.view'); 
        }else{
            toastr()->error('Data has been not Update');
            return back();  
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
        $data = User::find($id);

    if($data->image){
     
        $photo = $single->image;

        unlink($photo);

        $users = $data->delete();

    
    if($users){
        
        toastr()->success('Data has been Deleted');
         return redirect()->route('users.view');   
    }else{

        toastr()->error('Data has been not Deleted');
        return back();   
    } 

    }else{

    $dltuser =User::find($id)->delete();
    if($dltuser){
        
        toastr()->success('Data has been Deleted');
        return redirect()->route('users.view');    
    }else{

        toastr()->error('Data has been not Deleted');
        return back();   
    }

}




    }
}
