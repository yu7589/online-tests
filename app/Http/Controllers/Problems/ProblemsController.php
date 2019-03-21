<?php

namespace App\Http\Controllers\Problems;

use App\Problem;
use App\ProblemState;
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
        $problems = Problem::paginate(5);
        $problemstates = ProblemState::all();
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
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
        //dd($request->problem_id);
        $problems = Problem::paginate(5);
        $problemstates = ProblemState::all();

        foreach($problems as $problem){
            foreach($problemstates as $problemstate){
                if($problem->id == $problemstate->problem_id && $problemstate->problem_id == $request->problem_id){
                    if($problem->answer == $request->answer){
                        $problemstate -> correct_submit = $problemstate -> correct_submit + 1;
                    }
                    if($request->answer != null){
                        $problemstate->all_submit = $problemstate->all_submit + 1;
                    }
                    $problemstate->save();
                    //echo $request->problem_id;
                }
            }
        }
        return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
