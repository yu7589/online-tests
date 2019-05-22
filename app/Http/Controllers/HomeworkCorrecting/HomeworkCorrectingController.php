<?php

namespace App\Http\Controllers\HomeworkCorrecting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use App\Homework;
use Illuminate\Support\Facades\DB;
use App\User;
use App\ProblemSubmit;

use EndaEditor;

class HomeworkCorrectingController extends Controller
{
    public function index(Request $request)
    {
        //
        $classname = $request->input('classname');

        $homeworks = Homework::all();
        $problems = Problem::all();

        $judg = array(3,4);

        if($classname != null){
            $problemCompletes = ProblemComplete::where([['classname', '=', $classname], ['rightness', '=', 100]])->whereIn('type', $judg)->paginate(10);
            return view('homeworkCorrecting\homeworkCorrecting', ['problems'=>$problems, 'problemCompletes'=>$problemCompletes, 'classname'=>$classname]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problemCompletes = ProblemComplete::where([['rightness', '=', 100]])->whereIn('type', $judg)->paginate(10);
            return view('homeworkCorrecting\homeworkCorrecting', ['problems'=>$problems, 'problemCompletes'=>$problemCompletes, 'classname'=>$classname]);
        }
    }

    public function store(Request $request){
        $answer = $request->answer;
        
        //dd($answer);

        $values = explode('_', $answer);
        //dd($values);
        $student_number = $values[2];
        $problem_id = $values[3];
        $rightness = $values[0];
        $comment = $values[1];

        $problemcomplete = ProblemComplete::where([['student_number', '=', $student_number], ['problem_id', '=', $problem_id]])->get();
        foreach($problemcomplete as $complete){
            $complete->comment = $comment;
            $complete->rightness = $rightness;
            $complete->save();
        }
        return redirect('homeworkCorrecting');
    }
}
    
