<?php

namespace App\Http\Controllers\ProblemEdit;

use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProblemEditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $problems = DB::table('problems')->paginate(10);
        $problemstates = ProblemState::all();
        $problemcompletes = ProblemComplete::all();
        return view('problemEdit\problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemcompletes]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->problem_id);
        $problem = Problem::find($request->problem_id);
        $problem->chapter = $request->chapter;
        $problem->section = $request->section;
        $problem->stem = $request->stem;
        $problem->answer = $request->answer;
        $problem->picture_url1 = $request->picture_url1;
        $problem->picture_url2 = $request->picture_url2;
        $problem->explanation = $request->explanation;
        $problem->type = $request->type;
        $problem->author = $request->author;
        $problem->difficulty = $request->difficulty;
        $problem->save();
        return redirect('problemEdit');
    }

    public function delete(Request $request)
    {
        //dd($request->problem_id);
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = Problem::find($request->problem_id)->Delete();
        return redirect('problemEdit');
    }
}
