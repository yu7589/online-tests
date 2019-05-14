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
    public function index()
    {
        //跳转到题库页面
        //$problems = DB::table('problems')->paginate(10);
        $problems = DB::table('problems')->paginate(10);
        $problemstates = ProblemState::all();
        $problemcompletes = ProblemComplete::all();
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemcompletes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ///dd($request->student_number);
        $problems = Problem::all();

        $answers = explode('_', $request->answer);

        for($i=0; $i<count($answers)-2; $i=$i+2){
            $problemsubmit = new ProblemSubmit;
            foreach($problems as $problem){
                if($problem->id == $answers[$i]){
                    $problemsubmit->problem_id = $answers[$i];
                    $problemsubmit->student_number = $request->student_number;
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

    public function display(Request $request)
    {
        //dd($request->selectChapter);
        if($request->selectChapter != null && $request->selectSection != null){
            $problems = Problem::where([['chapter', '=', $request->selectChapter], ['section', '=', $request->selectSection]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
        }else if($request->selectChapter != null && $request->selectSection == null){
            $problems = Problem::where([['chapter', '=', $request->selectChapter]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
        }else if($request->selectChapter == null && $request->selectSection != null){
            $problems = Problem::where([['section', '=', $request->selectSection]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
        }else {
            $problems = Problem::paginate(10);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
        }
    }
}
