<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipt;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $ipt_id = $request->get('ipt_id');
        $email = $request->get('email');

        if (!empty($email) && !empty($ipt_id)) {            
            Session::put('ipt_id', $ipt_id);
            Session::put('email', $email);

            $ipt_id = Session::get('ipt_id');
            $email = Session::get('email');

            
            $users = User::whereNotNull('ipt_id') 
            ->where('ipt_id', '=', $ipt_id)
            ->where('email', '=', $email) 
            ->paginate(10);              

         }else if (!empty($ipt_id)) {
              Session::put('ipt_id', $ipt_id);
             
          
                $users = User::where('ipt_id', '=', $ipt_id)
                ->paginate(10); 

         }elseif (!empty($email)) {
             Session::put('email', $email);             
             $email = Session::get('email');

           
                $users = User::where('email', 'LIKE', '%'.$email.'%')
                ->paginate(10); 
         } else {
            
                $users = User::whereNotNull('ipt_id') 
                ->paginate(10);
         }

         $ipts = Ipt::orderBy('ipt', 'asc')->get();
      // dd($users);
        return view('student.index',compact('users','ipts','ipt_id','email'));
    }

    public function editForm($id)
    {
        $users = User::find($id);
        $act='edit';
        $ipts = Ipt::orderBy('ipt', 'DESC')->get(); 
        return view('student.form',compact('ipts','users','act'));
    }

    public function edit(Request $request)
    {
            $angka_giliran = $request->get('angka_giliran');
            $id = $request->get('id');
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->no_kp = $request->get('no_kp'); 
            $user->ipt_id = $request->get('ipt_id');
            $user->email = $no_kp;
            $user->password =  Hash::make($angka_giliran);
            $user->save();
           // dd($user);

        return redirect()->route('student.index')->with('success', 'Berjaya dikemaskini');;
    }


    public function form()
    {
        $ipts = Ipt::orderBy('ipt', 'ASC')->get(); 
        $act='';
        return view('student.form',compact('ipts','act'));
    }

    protected function create(Request $request, User $user)
    {
        $request->validate([
            'no_kp'=>'required|unique:users,email', 
            'ipt_id'=>'required',
			'angka_giliran'=>'required', 
        ]);
        //dd($request->get('ipt_id'));
        $no_kp = $request->get('no_kp');
         $angka_giliran = $request->get('angka_giliran');

        $user = new User([
            'name' => $request->get('name'), 
            'no_kp' => $no_kp,
            'email' => $no_kp,
            'ipt_id' => $request->get('ipt_id'),
            'password' => Hash::make($angka_giliran),
        ]);
        $user->save();

        return redirect('/student')->with('success', 'Saved!');
    }

    public function destroy($id)
    {
        
        $user = User::findOrFail($id);
         
        $user->delete();

        Session::flash('success', 'Berjaya dipadam!');

        //return redirect()->route('student.index');
        return redirect('/student')->with('success', 'Berjaya disimpan !');
        
    }

    public function user_answer($id)
    {
        $users = User::find($id);
        $userAnswers = userAnswer::where('user_id',$id) 
        ->join('questions','questions.id','=','user_answers.question_id')
        ->orderby('questions.question_type_id','ASC')
        ->paginate(50);   
       
        return view('student.user_answer',compact('userAnswers','users'));
    }


}
