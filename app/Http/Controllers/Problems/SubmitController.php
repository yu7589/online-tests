<?php

namespace App\Http\Controllers\Problems;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use App\ProblemSubmit;
use Illuminate\Support\Facades\DB;


class SubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $problemsubmit = DB::table('problemsubmit')->paginate(10);
        $problems = Problem::all();
        return view('problems\submit', ['problemsubmit'=>$problemsubmit, 'problems'=>$problems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        
        //dd($request->student_number);
        
        $problemsubmit = ProblemSubmit::all();
        $problems = Problem::all();
        $problemstates = ProblemState::all();

        $count = 0;
        foreach($problemsubmit as $submit){
            if($submit->student_number == $request->student_number){
                $count = 1;
                foreach($problems as $problem){
                    foreach($problemstates as $problemstate){
                        if($submit->problem_id == $problem->id && $problemstate->problem_id == $problem->id){
                            //dd($request->problem_id);
                            if($problem->answer == $submit->student_answer){
                                $problemstate->correct_submit = $problemstate->correct_submit + 1;
                                $problemstate->all_submit = $problemstate->all_submit + 1;
                                $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);
                            }else{
                                $problemstate->all_submit = $problemstate->all_submit + 1;
                                $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);
                            }
                            $problemstate->save();
                            //echo $request->problem_id;
                        }
                    }
                }
                $submit->delete();
            }
        }
        if($count == 1){
            return redirect('submit')->with('status', '提交成功');
        }
        else{
            return redirect('submit')->with('status', '没有提交中的回答');
        }
        
    }

    public function delete(Request $request)
    {
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = ProblemSubmit::find($request->problem_id)->Delete();
        return redirect('submit')->with('status', '取消成功');
    }
}
