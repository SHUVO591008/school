<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Illuminate\Support\Facades\DB;
use App\user;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Every Minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$results = DB::table('users')->where('email','subratanath186@gmail.com')->get();

        $code = rand(0000,9999);
        $data = new User();
        $data->usertype = 'Admin';
        $data->role = 'admin';
        $data->name = 'test';
        $data->email = 'ab@gmail.com';
        $data->status = '1';
        $data->code = $code;
        $data->password =bcrypt($code );
        $users = $data->save();

       
           // $data = array('name'=>"Virat Gandhi");

            // Mail::send('email',array('result'=>$results), function($message) {

            //    $message->to('subratanath186@gmail.com', 'Tutorials Point')->subject
            //       ('Laravel HTML Testing Mail');
            //    $message->from('subratanath186@gmail.com','Virat Gandhi');

            // });
          
    }
}
