<?php

namespace App\Http\Controllers;

use App\Models\Fail;
use App\Models\Letter;
use App\Models\TypeFail;
use App\Models\Status;
use App\Models\Kulit;
use App\Models\SeqNumber;
use App\Models\User;  
use App\Models\Role;
use App\Models\Movement;  

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //$request->get('sess_id');
       // echo request()->sess_id;
        //Session::put('sess_id', request()->sess_id);
        //echo "==>".Session::get('sess_id');
        //echo "==>".Session::get('sess_id');
        $fail_id = $request->fail_id;        
        
        $fails = Fail::WHERE('status_id',1)->orderBy('title','ASC')->get();

        if(!empty($fail_id)){

            $val = $request->get('val');
            $type = $request->get('type');

            if($type == "letter"){
                $letters = Letter::WHERE('fail_id', $fail_id)
                ->orderBy('seq_no','DESC') 
                ->where('letter', 'LIKE', "%$val%")
                ->limit(5)
                ->paginate(10);
            }else{
                $letters = Letter::WHERE('fail_id', $fail_id)
                ->orderBy('seq_no','DESC')                 
                ->limit(5)
                ->paginate(10);
            }

             

            $seq_number = Letter::WHERE('fail_id', $fail_id)
            ->orderBy('seq_no','DESC')
            ->first();
        }else{
            if(!empty($request->get('val'))){
                $type = $request->get('type');
                $val = $request->get('val');
                
                if($type == "letter"){
                    $letters = Letter::orderBy('id','DESC') 
                    ->where('letter', 'LIKE', "%$val%")
                    ->paginate(10);
                }else{
                    $letters = Letter::orderBy('id','DESC') 
                    ->where('ref_letter', 'LIKE', "%$val%")
                    ->paginate(10);
                }


            }else{
                    $letters = Letter::orderBy('id','DESC') 
                    ->paginate(10);
            }
            

            

            $seq_number='';
            
        }
        
        
        return view('home',compact('fails','letters','fail_id','seq_number'));
    }


    public function movement(Request $request)
    {
        //$request->get('sess_id');
       // echo request()->sess_id;
        //Session::put('sess_id', request()->sess_id);
        //echo "==>".Session::get('sess_id');
        //echo "==>".Session::get('sess_id');
        $fail_id = $request->fail_id;        
        
        $fails = Fail::orderBy('title','ASC')->get();
        $users = User::orderBy('name','ASC')->get();
        if(!empty($fail_id)){

            
                $movements = Movement::WHERE('fail_id', $fail_id)
                ->orderBy('id','DESC')   
                ->paginate(10);
            
        }else{
             
                    $movements = Movement::orderBy('id','DESC') 
                    ->paginate(10);
            
            
        }
        
        
        return view('movement',compact('movements','users','fails'));
    }

    protected function movement_store(Request $request)
    {
        
        $request->validate([
                'user_id'=>'required', 
                'fail_id'=>'required', 
        ]);
             
    
             

            $fail = new Movement([ 
                'user_id' => $request->get('user_id'), 
                'fail_id' => $request->get('fail_id'), 
                'return_estimate_date' => $request->get('return_estimate_date'),
                'date_movement' => $request->get('date_movement'), 
                'note' =>  $request->get('note'), 
                'created_by' =>  Session::get('sess_id'),
                
            ]);
            $fail->save(); 
        

        return redirect()->route('movement')->with('success', 'Saved!');
    }

    public function movement_delete($id)
    {
        $fail = Movement::findOrFail($id);

        $fail->delete();

        Session::flash('success', 'Berjaya dipadam!');

        return redirect()->route('movement');
    }

    public function movement_update(Request $request)
    {
            
            $id = $request->get('id');
            $data = Movement::find($id);
            $data->user_id = $request->get('user_id');
            $data->fail_id = $request->get('fail_id'); 
            $data->return_estimate_date = $request->get('return_estimate_date');
            $data->return_date = $request->get('return_date');
            $data->date_movement = $request->get('date_movement');
            $data->note = $request->get('note'); 
            $data->save(); 

        return redirect()->route('movement')->with('success', 'Berjaya dikemaskini');;
    }


    public function surat_form(Request $request)
    {
        $type = $request->type;
        $typefails = TypeFail::all(); 
        $statuss = Status::all();
       // dd($statusfails);
        $act='';
        return view('surat_form',compact('typefails','act','statuss','type'));
    }

    protected function surat_store(Request $request, Letter $fail)
    {
        if($request->get('in_out')==1){ //IN
            $request->validate([
                'ref_letter'=>'required', 
                'date_letter'=>'required',
                'sent_from'=>'required',  
            ]);
             
    
            $seq_number = Letter::WHERE('fail_id', $request->get('fail_id'))
            ->orderBy('seq_no','DESC')
            ->first();

            if(!empty($seq_number->seq_no)){
                $seq_no = $seq_number->seq_no+1;
            }else{
                $seq_no = 1;
            }

            $fail = new Letter([
                'seq_no' =>  $seq_no,
                'letter' => $request->get('letter'), 
                'ref_letter' => $request->get('ref_letter'), 
                'date_letter' => $request->get('date_letter'),
                'sent_from' => $request->get('sent_from'),
                'in_out' => $request->get('in_out'), 
                'fail_id' => $request->get('fail_id'),
                'created_by' => $id = Session::get('sess_id')
            ]);
            $fail->save();
            
            
            

        }else{ //OUT

            $request->validate([
                'letter'=>'required', 
                'sent_to'=>'required', 
            ]);
             
            $seq_number = Letter::WHERE('fail_id', $request->get('fail_id'))
            ->orderBy('seq_no','DESC')
            ->first();
            //dd($seq_number);

            if(!empty($seq_number->seq_no)){
                $seq_no = $seq_number->seq_no+1;
            }else{
                $seq_no = 1;
            }
    
            $fail = new Letter([
                'seq_no' =>  $seq_no,
                'letter' => $request->get('letter'), 
                'sent_to' => $request->get('sent_to'),
                'date_letter' => $request->get('date_letter'), 
                'in_out' => $request->get('in_out'), 
                'fail_id' => $request->get('fail_id'), 
                'created_by' => $id = Session::get('sess_id'),
            ]);
            $fail->save();

            

        }


        

        return redirect()->route('home', ['fail_id' => $request->get('fail_id')])->with('success', 'Saved!');
    }


    public function surat_edit($id)
    {
        $typefails = TypeFail::all(); 
        $statuss = Status::all();
        $fails = Fail::where('id',$id)->get();

        $act='edit';
        return view('fail_form',compact('typefails','act','statuss','fails'));
    }

    public function suratOut_update(Request $request)
    {
        $isExist = Letter::where('seq_no',$request->get('seq_no'))
        ->where('fail_id',$request->get('fail_id'))
        ->where('id', '!=' ,$request->get('id'))
        ->exists();

        //dd($request->get('fail_id'));
        //dd($request->get('seq_no'));

        if ($isExist) {
           // dd('Record is available.');
            return redirect()->back()->with('error', 'Maaf Tidak Berjaya dikemaskini');
        }else{
            $id = $request->get('id'); 
            $data = Letter::findOrFail($id);
            $data->seq_no = $request->get('seq_no');
            $data->letter = $request->get('letter');
            $data->sent_to = $request->get('sent_to'); 
            $data->date_letter = $request->get('date_letter');  
            $data->update_by = Session::get('sess_id'); 
            $data->save(); 

           return redirect()->back()->with('success', 'Berjaya dikemaskini');
        }

           
               
           
          
       
    }

    public function suratIn_update(Request $request)
    {
        $id = $request->get('id'); 

        $isExist  = Letter::where('seq_no',$request->get('seq_no'))
        ->where('fail_id',$request->get('fail_id'))
        ->where('id', '!=' ,$request->get('id'))
        ->exists();

       

        if ($isExist) {
            //dd('Record is available.');
            return redirect()->back()->with('error', 'Maaf Tidak Berjaya dikemaskini');
        }else{
           // dd('Record is not available.');
                 $data = Letter::findOrFail($id);
                 $data->seq_no = $request->get('seq_no');
                 $data->letter = $request->get('letter');
                $data->ref_letter = $request->get('ref_letter');
                $data->sent_from = $request->get('sent_from'); 
                $data->date_letter = $request->get('date_letter');  
                $data->update_by = Session::get('sess_id'); 
                $data->save();
                return redirect()->back()->with('success', 'Berjaya dikemaskini');
        }

           
       
    }



    public function surat_delete($id)
    {
        $fail = Fail::findOrFail($id);

        $fail->delete();

        Session::flash('success', 'Berjaya dipadam!');

        return redirect()->route('fail');
    }



    public function fail()
    {
        $fails = Fail::all();
        return view('fail',compact('fails'));
    }

    public function fail_form()
    {
        $typefails = TypeFail::all(); 
        $statuss = Status::all();
        $kulits = Kulit::all();
       // dd($statusfails);
        $act='';
        return view('fail_form',compact('typefails','act','statuss','kulits'));
    }

    protected function fail_store(Request $request, Fail $fail)
    {
        $request->validate([
            'ref_no'=>'required', 
            'title'=>'required',
			'typefail_id'=>'required', 
            'status_id'=>'required', 
        ]);
         

        $fail = new Fail([
            'ref_no' => $request->get('ref_no'), 
            'title' => $request->get('title'),
            'typefail_id' => $request->get('typefail_id'),
            'status_id' => $request->get('status_id'), 
            'desc_fail' => $request->get('desc_fail'),
            'kulit_id' => $request->get('kulit_id'),
        ]);
        $fail->save();

        return redirect('/fail')->with('success', 'Saved!');
    }


    public function fail_edit($id)
    {
        $typefails = TypeFail::all(); 
        $statuss = Status::all();
        $kulits = Kulit::all();
        $fail = Fail::where('id',$id)->first();

        $act='edit';
        return view('fail_form',compact('typefails','act','statuss','fail','kulits'));
    }

    public function fail_update(Request $request)
    {
            
            $id = $request->get('id');
            $data = Fail::find($id);
            $data->ref_no = $request->get('ref_no');
            $data->title = $request->get('title'); 
            $data->typefail_id = $request->get('typefail_id'); 
            $data->status_id = $request->get('status_id');
            $data->desc_fail = $request->get('desc_fail');
            $data->kulit_id = $request->get('kulit_id');
            $data->save(); 

        return redirect()->route('fail')->with('success', 'Berjaya dikemaskini');;
    }


    public function fail_delete($id)
    {
        $letter = Letter::where('fail_id', '=', $id)->first();
        if ($letter === null) {
            // user doesn't exist$fail = Fail::findOrFail($id);
            $fail = Fail::findOrFail($id);
            $fail->delete();

            Session::flash('success', 'Berjaya dipadam!');
        }else{
            
    
            Session::flash('error', 'Maaf tidak Berjaya dipadam!');

        }

       
 

        return redirect()->route('fail');
    }

    public function user()
    {
       
        $users = User::all();     

         
        return view('user.index',compact('users'));
    }

    public function user_form()
    {
        $act=''; 
        $roles = Role::all(); 
        return view('user.form',compact('act','roles'));
    }    

    

    protected function user_store(Request $request, User $user)
    {
        $request->validate([
            'email'=>'required|unique:users,email', 
            'name'=>'required', 
        ]);
        $password = $request->get('password');
        //dd($password);

        $user = new User([
            'name' => $request->get('name'), 
            'email' => $request->get('email'),
            'password' => Hash::make($password),
        ]);
        $user->save();

        return redirect()->back()->with('success', 'Berjaya disimpan');
    }

    public function user_edit($id)
    {
        $act='edit'; 
        $roles = Role::all(); 
        $user = User::where('id', $id)->first();
        return view('user.form',compact('act','roles','user'));
    }  

    public function user_update(Request $request)
    {
            
            $id = $request->get('id');
            $data = User::find($id);
            $data->name = $request->get('name');
            $data->role_id = $request->get('role_id');  
            $data->save(); 

        return redirect()->route('user')->with('success', 'Berjaya dikemaskini');;
    }

 



}
