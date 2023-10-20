<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserAnswerController extends Controller
{
    //
    public function exam()
    {
		return redirect('/home')->with('success', 'Saved!');
		
        $id = Auth::user()->id;
        $result = UserAnswer::where('user_id',$id )->first();
       
        if ($result) {
            echo "set soalan dah create";
            
        }else{
            
            //$questions = Question::inRandomOrder()->get()->where('question_type_id', 1)->random(50);
			$questions = Question::get()->where('question_type_id', 1);
            foreach($questions as $question){
                $question = new UserAnswer([
                    'question_id' => $question->id, 
                    'user_id' => $id,
                ]);
                $question->save();
            } 
           
            //$questionSubjectives = Question::get()->where('question_type_id', 2)->random(5);
			$questionSubjectives = Question::get()->where('question_type_id', 2);
            foreach($questionSubjectives as $questionSubjective){
                $questionSubjective = new UserAnswer([
                    'question_id' => $questionSubjective->id, 
                    'user_id' => $id,
                ]);
                $questionSubjective->save();
            }
           
            echo "set soalan baru jana";
        }
        

         

       // return view('user.exam',compact('questions'));
       return redirect('/user_exam')->with('success', 'Contact saved!');
    }

    public function user_exam(Request $request)
    {
        $id = Auth::user()->id;
        //$userAnswers = UserAnswer::where('user_id',$id )->paginate(1); 
       $userAnswers = DB::table('user_answers')
        ->join('questions', 'questions.id', '=', 'user_answers.question_id') 
        //->select('user_answers.id as id, questions.question as question, user_answers.question_id as question_id')
        ->select('user_answers.*', 'questions.question',)
        ->where('user_answers.user_id', $id)
        ->where('questions.question_type_id', 1)
        ->paginate(1);
        $request = $request;

        $user_jawab = UserAnswer::where('user_id',$id )->whereNotNull('question_option_id')->get(); 
        $count = $user_jawab->count();

       return view('user.exam',compact('userAnswers','request','count'));
    }

    public function examSubmit(Request $request)
    {
        $currentURL =  url()->previous();
        $page = $request->page;
        // dd($page);   
            $id = $request->get('id');
            $userAnswer = UserAnswer::find($id);
            $userAnswer->question_option_id = $request->get('question_option_id'); 
            $userAnswer->save();

           // return redirect('/user_exam' ,['page' =>$page])->with('success', 'Contact saved!');
           return redirect()->back();
    }

    public function user_exam_subjective(Request $request)
    {
        return redirect('/home')->with('success', 'Saved!');
		
		$id = Auth::user()->id;

        $check = UserAnswer::where('user_id',$id)->first(); 
       // dd($check);
        if(!$check){
            return redirect('/exam')->with('error', 'Sila jawab soalan subjektif!');
        }

        
       // $userAnswers = UserAnswer::where('user_id',$id )->paginate(1); 
        $questions = $query = DB::table('questions')
        ->join('user_answers', 'questions.id', '=', 'user_answers.question_id') 
        ->select('questions.*', 'user_answers.answer',)
        ->where('user_answers.user_id', $id)
        ->where('questions.question_type_id', 2)
        ->paginate(1);
        //$request = $request;

        $soalanSubjective = Question::where('question_type_id','2')->get(); 
        $countSoalan = $soalanSubjective->count();
        //dd($countSoalan);

        $userJawab = UserAnswer::where('user_id',$id )
        ->join('questions','questions.id', '=','user_answers.question_id')
        ->where('user_answers.answer','!=','')
        ->where('question_type_id','2')->get(); 

        $count = $userJawab->count();

       // dd($questions);
       return view('user.exam_subjective',compact('questions','request','count','countSoalan'));
    }

    public function subjectiveStore(Request $request)
    {
        
        $request->validate([
            'answer'=>'required'
        ]);
        
        $currentURL =  url()->previous();
        $user_id = Auth::user()->id; 
        // dd($page);   
            $question_id = $request->get('question_id');
            $userAnswer = UserAnswer::where('question_id', $question_id)->where('user_id', $user_id)->first();
            //dd($userAnswer);
            if(empty($userAnswer->question_id)){              
                //echo "save";
                $userAnswer = new UserAnswer;
                $userAnswer->question_id = $request->get('question_id'); 
                $userAnswer->answer = $request->get('answer');
                $userAnswer->user_id = $user_id; 
                $userAnswer->save();
            }else{
                echo "edit";
                DB::table('user_answers')
                ->where('user_id', $user_id)
                ->where('question_id', $question_id)
                ->update(['answer' => $request->get('answer')]);
                
            }
            //$userAnswer->question_option_id = $request->get('question_option_id'); 
            //$userAnswer->save();

           // return redirect('/user_exam' ,['page' =>$page])->with('success', 'Contact saved!');
           return redirect()->back();
    }
}
