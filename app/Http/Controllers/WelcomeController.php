<?php

namespace App\Http\Controllers;

use App\Models\Fail;
use App\Models\Letter;
use App\Models\TypeFail;
use App\Models\Status;
use App\Models\Kulit;
use App\Models\SeqNumber;
use App\Models\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         
        $fail_id = $request->fail_id;        
        
        $fails = Fail::WHERE('status_id',1)->orderBy('title','ASC')->get();

        if(!empty($fail_id)){
            $letters = Letter::WHERE('fail_id', $fail_id)
            ->orderBy('seq_no','DESC')
            ->limit(5)
            ->get();
            $seq_number = Letter::WHERE('fail_id', $fail_id)
            ->orderBy('seq_no','DESC')
            ->first();
        }else{
            $letters = Letter::orderBy('id','DESC')
            ->limit(5)
            ->get();
            $seq_number='';
            
        }
         

        
        return view('welcome',compact('fails','letters','fail_id','seq_number'));
    }

    public function efail_list()
    {
        //echo "==>".Session::get('sess_name');
        //echo "==>".Session::get('sess_id');

        $fails = Fail::all();
        return view('efail_list',compact('fails'));
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();   //get db User data   
       
        if(Hash::check($password, $user->password)) {   
                //echo "OK";
                Session::put('sess_name', $user->name);
                Session::put('sess_id', $user->id);
                 
                //$sess_id = Session::get('sess_id');
                Auth::login($user);
                //Session::save();
                //return redirect('/home',['sess_name'=>$sess_name])->with('success', 'Contact saved!');
                //return redirect()->route('home',['sess_id'=>$sess_id]);
                 
                return redirect('/home')->with('success', 'Contact saved!');
        }else{
            //echo "FALSE";
            return redirect('/login')->with('success', 'Contact saved!');
        }
       
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('success', 'Contact saved!');
    }

}
