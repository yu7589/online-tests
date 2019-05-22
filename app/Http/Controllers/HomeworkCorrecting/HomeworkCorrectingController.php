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
        $score = $request->answer_score;
        $comment = $request->answer_comment;
        $student_number = $request->student_number;
        $problem_id = $request->problem_id;
        
        dd($comment);
        $problemcomplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
        foreach($problemcomplete as $complete){
            dd($complete->problem_id);
        }

    }
}
    
