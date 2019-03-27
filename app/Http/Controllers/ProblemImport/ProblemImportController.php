<?php

namespace App\Http\Controllers\ProblemImport;

use App\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProblemImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('problemImport\problemImport');
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
        dd($request->QU);
        $problem = new Problem;
        $problem->chapter = $request->QU;
        $problem->section = $request->QU;
        $problem->stem = $request->QU;
        $problem->picture_url1 = $request->QU;
        $problem->picture_url2 = '';
        $problem->answer = $request->QU;
        $problem->type = $request->QU;
        $problem->difficulty = 1;
        $problem->author = $request->QU;
        $problem->save();
        return view('problemImport\problemImport');
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
