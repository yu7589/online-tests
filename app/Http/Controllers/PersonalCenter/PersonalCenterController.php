<?php

namespace App\Http\Controllers\PersonalCenter;

use App\User;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MarkDowner;
use EndaEditor;

class PersonalCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->user()->student_number);

        $selectRight = 0;
        $selectCount = 0;
        $selectRate = 0;

        $judgmentRight = 0;
        $judgmentCount = 0;
        $judgmentRate = 0;

        $fillblankRight = 0;
        $fillblankCount = 0;
        $fillblankRate = 0;

        $shortanswerRight = 0;
        $shortanswerCount = 0;
        $shortanswerRate = 0;

        $problemComplete = ProblemComplete::all();
        foreach($problemComplete as $complete){
            if($complete->student_number == $request->user()->student_number){
                switch($complete->type){
                    case 1:
                        $judgmentCount = $judgmentCount + 1;
                        if($complete->rightness == 1){
                            $judgmentRight = $judgmentRight + 1;
                            $judgmentRate = round($judgmentRight/$judgmentCount, 3);
                        }
                        else{
                            $judgmentRate = round($judgmentRight/$judgmentCount, 3);
                        }
                        break;
                    case 2:
                        $selectCount = $selectCount + 1;
                        if($complete->rightness == 1){
                            $selectRight = $selectRight + 1;
                            $selectRate = round($selectRight/$selectCount, 3);
                        }
                        else{
                            $selectRate = round($selectRight/$selectCount, 3);
                        }
                    break;
                    case 3:
                        $fillblankCount = $fillblankCount + 1;
                        if($complete->rightness == 1){
                            $fillblankRight = $fillblankRight + 1;
                            $fillblankRate = round($fillblankRight/$fillblankCount, 3);
                        }
                        else{
                            $fillblankRate = round($fillblankRight/$fillblankCount, 3);
                        }
                        break;
                    case 4:
                        $shortanswerCount = $shortanswerCount + 1;
                        if($complete->rightness == 1){
                            $shortanswerRight = $shortanswerRight + 1;
                            $shortanswerRate = round($shortanswerRight/$shortanswerCount, 3);
                        }
                        else{
                            $shortanswerRate = round($shortanswerRight/$shortanswerCount, 3);
                        }
                        break;
                }
            }
            else{
                continue;
            }
        }
        $state = array($judgmentCount, $judgmentRight, $judgmentRate, $selectCount, $selectRight, $selectRate, $fillblankCount, $fillblankRight, $fillblankRate, $shortanswerCount, $shortanswerRight, $shortanswerRate);
        return view('personalCenter\personalCenter', ['state'=>$state]);
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
