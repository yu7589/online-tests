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
use App\PaperProblem;

class PaperSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //跳转到组卷页面
        $problemsubmit = DB::table('paperproblems')->paginate(10);
        $problems = Problem::all();
        return view('autoTestPaper\submit', ['problemsubmit'=>$problemsubmit, 'problems'=>$problems]);
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

    public function delete(Request $request)
    {
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = PaperProblem::find($request->problem_id)->Delete();
        return redirect('autoTestPaper\submit')->with('status', '取消成功');
    }
}