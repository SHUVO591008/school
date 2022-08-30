<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\model\message;
use App\typing;
use Illuminate\Support\Facades\Response;
use Auth;
use Session;
use DB;
use URL;
use Illuminate\Support\Str;

class messagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::id();
        $user = user::whereNotIn('id',[$auth_id])->get();

        return view('backend.message.messanger',compact('user'));
    }


    public function allmessage()
    {
        $auth_id = Auth::id();
        $user = user::whereNotIn('id',[$auth_id])->get();

        return view('backend.message.allmessage',compact('user'));
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






function callmessage($id){

        $user = DB::table('users')->where('id',$id)->first();
        $user->name;
        $auth_id=Auth::id();
        $chats = message::where('sender',$auth_id)
                     ->where('recever',$id)
                     ->Orwhere('sender',$id)
                     ->where('recever',$auth_id)
                     ->get();

        foreach($chats as $chat){

            if($chat->sender != $auth_id){


                if($chat->image==null){
                    $image = '';
                }else{
                    $image = '<img width="50" height="50" src="'.asset($chat->image).'">';
                }


                echo '<li style="list-style:none;">

                <div class="d-flex justify-content-start mb-4">

                <div class="img_cont_msg">

                    <img src="'.asset($user->image).'" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer">

                '. $chat->message .'
                '.$image.'

                    <span class="msg_time">'. $chat->created_at->diffForHumans() .'</span>
                </div>
            </div>
            </li>';


            }else{

                if($chat->image==null){
                    $image = '';
                }else{
                    $image = '<img width="50" height="50" src="'.asset($chat->image).'">';
                }

                if($chat->is_seen==1 and $chat->is_user_seen==1){
                    $seen ='';
                }else{
                    $seen = '<span><i class="fa fa-check" aria-hidden="true"></i></span>';
                }

                echo '<li style="list-style:none;" id="'.$chat->id.'" class="right clearfix">

                <div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send">
                <span onclick="deleteMessage('.$chat->id.')" class="close"  aria-label="close">&times;</span>


                '.$seen.'
                '. $chat->message .'
                '.$image.'

                    <span class="msg_time_send">'. $chat->created_at->diffForHumans() .'</span>


                </div>


                <div class="img_cont_msg">

                <img src="'.asset(Auth::user()->image).'" class="rounded-circle user_img_msg">
                    </div>
                </div>
            </li>';

            }
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function store(Request $request){

    $dataChack1 = user::findOrFail($request->sender);
    $dataChack2 = user::findOrFail($request->recever);


        $chat = new message;
        $chat->message = $request->message;
        $chat->sender = $request->sender;
        $chat->recever = $request->recever;

        $image = $request->file('image');

        if($image){
            $img_name = rand();
            $text =strtolower($image->getClientOriginalExtension());
            $img_full_name = $img_name.'.'.$text;
            $upld_path ='message/';
            $img_url =$upld_path. $img_full_name;
            $success =$image->move($upld_path,$img_full_name);
            $chat->image=$img_url;
        }


        $chat->save();

        typing::where('recever',$chat->recever)
              ->where('sender', $chat->sender)
              ->update(['check_status' => 0]);
        return back();
}


public function typing(Request $request){
    $auth_id=Auth::id();
   echo $id= $request->recever;
   if($request->text==null){
    echo $text= '';
   }else{
    echo $text= $request->text;
   }


   message::where('recever',$auth_id)
            ->where('is_user_seen',1)
            ->where('sender',$id)
            ->update(['is_user_seen' => 0]);

    message::where('recever',$auth_id)
            ->where('is_seen',1)
            ->where('sender',$id)
            ->update(['is_seen' => 0]);

    $typing_check = DB::table('typings')->where('recever',$id)
                              ->where('sender',$auth_id)
                              ->first();
    if($typing_check){
        DB::table('typings')->where('recever',$id)
            ->where('sender',$auth_id)
            ->update(['check_status' => $text]);
    }else{
        $typing = new typing;
        $typing->recever = $id;
        $typing->sender = Auth::id();
        $typing->save();
    }
}


public function typinc_receve($id){
    $typing_receve= DB::table('typings')->where('recever',Auth::id())
                        ->where('sender',$id)
                        ->first();
       if(isset( $typing_receve)){
           return  $typing_receve->check_status;
       }

}


public function deletemessage($id){
    $img = message::where('id',$id)->first();
    $img_path = $img->image;
    unlink($img_path);
    DB::table('messages')->where('id',$id)
                      ->delete();

}


public function seenMessage(){
    $auth_id=Auth::id();

    $t = message::where('recever',$auth_id)
                ->where('is_seen',1)
                ->get()
                ->count();
    print_r($t);
}

public function seenUpdate(){
    $auth_id=Auth::id();
    $chats = message::where('recever',$auth_id)
    ->where('is_seen',1)
    ->update(['is_seen' => 0]);

}


public function allMessageView(){
    $url=URL::to('messages/');
    $users = DB::table('users')->get();

    foreach($users as $user){

        if(Auth::id()!=$user->id){

            $message = DB::table('messages')->where('recever',Auth::id())
                                         ->where('sender',$user->id)
                                         ->orderBy('id','desc')
                                         ->first();
            $msgcount = DB::table('messages')->where('recever',Auth::id())
                                          ->where('sender',$user->id)
                                          ->where('is_user_seen',1)
                                          ->get()
                                          ->count();

            $online = ($user->online==0)?"":"online_icon";
            $line = ($user->online==0)?"is offline":"is online";



            if($msgcount>0){
                $msg="(". $msgcount  .")";
                $start_b='<b>';
                $end_b='</b>';
            }else{
                $msg="";
                $start_b='';
                $end_b='';
            }


        if(isset($message)){
            $srtmessage=Str::limit($message->message, 40);

            echo '<a onclick="singleSeenUpdate('.$user->id.')" style="text-decoration: none" href="'.$url.'/'.$user->id.'">
            <li id="row{{ $item->id }}"  style="cursor: pointer" class="{{ ($item->id==$recever)?"active":"" }}">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img src="'.URL::asset($user->image).'" class="rounded-circle user_img">
                        <span class="'.$online.'"></span>
                    </div>
                    <div class="user_info">
                        <span> '. $user->name . $msg .'</span>
                        <p style="color:black">

                        '. $start_b . $srtmessage .$end_b.'

                         </p>
                        <p>'.$user->name.' '.$line.'</p>
                    </div>
                </div>
            </li>
        </a>';
          }

        }
    }

}


public function singleSeenUpdate($id){
    $auth_id=Auth::id();
    message::where('recever',$auth_id)
            ->where('is_user_seen',1)
            ->where('sender',$id)
            ->update(['is_user_seen' => 0]);
    message::where('recever',$auth_id)
            ->where('is_seen',1)
            ->where('sender',$id)
            ->update(['is_seen' => 0]);
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
