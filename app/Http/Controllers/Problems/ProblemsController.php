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
        //dd($request->answer);
        /*
        $problems = Problem::all();
        $problemstates = ProblemState::all();

        foreach($problems as $problem){
            foreach($problemstates as $problemstate){
                if($problem->id == $problemstate->problem_id && $problemstate->problem_id == $request->problem_id){
                    //dd($request->problem_id);
                    if($request->answer != null){
                        $problemstate->all_submit = $problemstate->all_submit + 1;
                    }
                    if($problem->answer == $request->answer){
                        $problemstate->correct_submit = $problemstate->correct_submit + 1;
                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);
                    }else{
                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);
                    }
                    $problemstate->save();
                    //echo $request->problem_id;
                }
            }
        }
        $problems = DB::table('problems')->paginate(10);
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
        */
        $problems = DB::table('problems')->paginate(10);
        $problemstates = ProblemState::all();
        $problemcompletes = ProblemComplete::all();
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemcompletes]);
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
