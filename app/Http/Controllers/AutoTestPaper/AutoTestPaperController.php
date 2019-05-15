<?php

namespace App\Http\Controllers\AutoTestPaper;


use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProblemSubmit;

class AutoTestPaperController extends Controller
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
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null){
            $problems = Problem::where([['section', '=', $section]])->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
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
     * 将提交的数据保存到数据库中 
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

        return redirect('autoTestPaper')->with('status', '已提交');
    }

    /*
    *显示试卷，用于打印
    */
    public function show()
    {
        //
        $counts = array(0,1,2,3,4,5,6,7,8,9);
        $problems = Problem::all();
        return view('autoTestPaper\testPaper', ['problems'=>$problems, 'counts'=>$counts]);
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
}
