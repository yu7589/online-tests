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
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        //dd($request->problem_id);
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = Problem::find($request->problem_id)->forceDelete();
        $problems = DB::table('problems')->paginate(10);
        $problemstates = ProblemState::all();
        $problemcompletes = ProblemComplete::all();
        return view('problemEdit\problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemcompletes]);
    }
}
