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

        $count = 0;
        foreach($problemsubmit as $submit){
            if($submit->student_number == $request->student_number){
                $count = 1;
                //dd($submit->problem_id);
                $problems = Problem::where('id', '=', $submit->problem_id)->get();
                foreach($problems as $problem){
                    $problemstates = ProblemState::where('problem_id', '=', $submit->problem_id)->get();
                    foreach($problemstates as $problemstate){
                        if($submit->problem_id == $problem->id && $problemstate->problem_id == $problem->id){
                            switch($problem->type){
                                case 1:
                                    if($problem->answer == $submit->student_answer){
                                        $problemstate->correct_submit = $problemstate->correct_submit + 1;
                                        $problemstate->all_submit = $problemstate->all_submit + 1;
                                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);

                                        $problemcomplete = new ProblemComplete;
                                        $problemcomplete->completed = 1;
                                        $problemcomplete->student_number = $submit->student_number;
                                        $problemcomplete->problem_id = $submit->problem_id;
                                        $problemcomplete->classname = $problem->classname;
                                        $problemcomplete->chapter = $problem->chapter;
                                        $problemcomplete->section = $problem->section;               
                                        $problemcomplete->type = 1;
                                        $problemcomplete->answer_save = $submit->student_answer;
                                        $problemcomplete->rightness = 1;
                                        $problemcomplete->comment = 0;
                                        $problemcomplete->save();
                                    }else{
                                        $problemstate->all_submit = $problemstate->all_submit + 1;
                                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);

                                        $problemcomplete = new ProblemComplete;
                                        $problemcomplete->completed = 1;
                                        $problemcomplete->student_number = $submit->student_number;
                                        $problemcomplete->problem_id = $submit->problem_id;
                                        $problemcomplete->classname = $problem->classname;
                                        $problemcomplete->chapter = $problem->chapter;
                                        $problemcomplete->section = $problem->section;           
                                        $problemcomplete->type = 1;
                                        $problemcomplete->answer_save = $submit->student_answer;
                                        $problemcomplete->rightness = 0;
                                        $problemcomplete->comment = 0;
                                        $problemcomplete->save();
                                    }
                                    $problemstate->save();

                                    break;
                                case 2:
                                    $answers = explode(";", $problem->answer, 4);
                                    $letter = '';
                                    //dd(substr_count($answers[2], '**'));
                                    for($i=0; $i<4; $i++){
                                        if(substr_count($answers[$i], '**') == 2){
                                            switch($i){
                                                case 0:
                                                    $letter = 'A';
                                                    break;
                                                case 1:
                                                    $letter = 'B';
                                                    break;
                                                case 2:
                                                    $letter = 'C';
                                                    break;
                                                case 3:
                                                    $letter = 'D';
                                                    break;
                                            }
                                        }
                                    }
                                    //dd($letter);
                                    if($letter == $submit->student_answer){
                                        $problemstate->correct_submit = $problemstate->correct_submit + 1;
                                        $problemstate->all_submit = $problemstate->all_submit + 1;
                                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);

                                        $problemcomplete = new ProblemComplete;
                                        $problemcomplete->completed = 1;
                                        $problemcomplete->student_number = $submit->student_number;
                                        $problemcomplete->problem_id = $submit->problem_id;
                                        $problemcomplete->classname = $problem->classname;
                                        $problemcomplete->chapter = $problem->chapter;
                                        $problemcomplete->section = $problem->section;               
                                        $problemcomplete->type = 2;
                                        $problemcomplete->answer_save = $submit->student_answer;
                                        $problemcomplete->rightness = 1;
                                        $problemcomplete->comment = 0;
                                        $problemcomplete->save();
                                    }else{
                                        $problemstate->all_submit = $problemstate->all_submit + 1;
                                        $problemstate->passing_rate = round($problemstate->correct_submit/$problemstate->all_submit, 3);

                                        $problemcomplete = new ProblemComplete;
                                        $problemcomplete->completed = 1;
                                        $problemcomplete->student_number = $submit->student_number;
                                        $problemcomplete->problem_id = $submit->problem_id;
                                        $problemcomplete->classname = $problem->classname;
                                        $problemcomplete->chapter = $problem->chapter;
                                        $problemcomplete->section = $problem->section;           
                                        $problemcomplete->type = 2;
                                        $problemcomplete->answer_save = $submit->student_answer;
                                        $problemcomplete->rightness = 0;
                                        $problemcomplete->comment = 0;
                                        $problemcomplete->save();
                                    }
                                    $problemstate->save();

                                    break;
                                case 3:
                                    $problemstate->all_submit = $problemstate->all_submit + 1;

                                    $problemcomplete = new ProblemComplete;
                                    $problemcomplete->completed = 1;
                                    $problemcomplete->student_number = $submit->student_number;
                                    $problemcomplete->problem_id = $submit->problem_id;
                                    $problemcomplete->classname = $problem->classname;
                                    $problemcomplete->chapter = $problem->chapter;
                                    $problemcomplete->section = $problem->section;               
                                    $problemcomplete->type = 3;
                                    $problemcomplete->answer_save = $submit->student_answer;
                                    $problemcomplete->rightness = 100;
                                    $problemcomplete->comment = 1;
                                    $problemcomplete->save();

                                    $problemstate->save();
                                break;
                                    break;
                                case 4:
                                    $problemstate->all_submit = $problemstate->all_submit + 1;

                                    $problemcomplete = new ProblemComplete;
                                    $problemcomplete->completed = 1;
                                    $problemcomplete->student_number = $submit->student_number;
                                    $problemcomplete->problem_id = $submit->problem_id;
                                    $problemcomplete->classname = $problem->classname;
                                    $problemcomplete->chapter = $problem->chapter;
                                    $problemcomplete->section = $problem->section;               
                                    $problemcomplete->type = 4;
                                    $problemcomplete->answer_save = $submit->student_answer;
                                    $problemcomplete->rightness = 100;
                                    $problemcomplete->comment = 1;
                                    $problemcomplete->save();

                                    $problemstate->save();

                                    break;
                            }
                        }
                    }
                }
                $submit->delete();
            }
        }
        if($count == 1){
            return redirect('problems')->with('status', '提交成功');
        }
        else{
            return redirect('problems')->with('status', '没有提交中的回答');
        }
        
    }

    public function delete(Request $request)
    {
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = ProblemSubmit::find($request->problem_id)->Delete();
        return redirect('submit')->with('status', '取消成功');
    }
}
