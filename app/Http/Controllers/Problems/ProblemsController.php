<?php

namespace App\Http\Controllers\Problems;

use App\User;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use App\ProblemSubmit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //跳转到题库页面
        $student_number = $request->user()->student_number;
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        $judg = array();
        $count = 0;
        $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($problemComplete as $complete){
                if($problem->id == $complete->problem_id){
                    $judg[$count] = $problem->id;
                    $count++;
                    continue;
                }
                else{
                    continue;
                }
            }
        }

        if($chapter != null && $section != null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'judg'=>$judg, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
            $problems = Problem::where([['chapter', '=', $chapter]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'judg'=>$judg, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
            $problems = Problem::where([['section', '=', $section]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'judg'=>$judg, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else {
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
            //dd($problemComplete[0]->student_number);
            $problems = Problem::paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'judg'=>$judg, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

    /**
     * 将提交的数据保存到problemsubmit数据库中 
     */
    public function store(Request $request)
    {
        //dd($request->user()->student_number);
        $problems = Problem::all();

        $answers = explode('_', $request->answer);

        for($i=0; $i<count($answers)-2; $i=$i+2){
            $problemsubmit = new ProblemSubmit;
            foreach($problems as $problem){
                if($problem->id == $answers[$i]){
                    $problemsubmit->problem_id = $answers[$i];
                    $problemsubmit->student_number = $request->user()->student_number;
                    $problemsubmit->student_answer = $answers[$i+1];
                    $problemsubmit->save();
                }
                else{
                    continue;
                }
            }
        };

        return redirect('problems')->with('status', '已提交');
    }

    public function show(Request $request)
    {
        //跳转到已做答题目题库页面
        $student_number = $request->user()->student_number;
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        if($chapter != null && $section != null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number], ['chapter', '=', $chapter], ['section', '=', $section]])->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number], ['chapter', '=', $chapter]])->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null){
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number], ['section', '=', $section]])->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else {
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }
}
