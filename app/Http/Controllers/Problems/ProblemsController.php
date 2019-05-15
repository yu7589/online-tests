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
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        if($chapter != null && $section != null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null){
            $problems = Problem::where([['section', '=', $section]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else {
            $problems = Problem::paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        dd($id);
        $problems = DB::table('problems')->paginate(10);
        $problemstates = ProblemState::all();
        $problemcompletes = ProblemComplete::all();
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemcompletes]);
    }
}
