<?php

namespace App\Http\Controllers\AutoTestPaper;


use App\Problem;
use App\PaperProblem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProblemSubmit;

class AutoTestPaperController extends Controller
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
        //跳转到组卷页面
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        $judg = array();
        $count = 0;
        $paperproblems = PaperProblem::all();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($paperproblems as $paperproblem){
                if($problem->id == $paperproblem->problem_id){
                    $judg[$count] = $problem->id;
                    $count++;
                    continue;
                }
                else{
                    continue;
                }
            }
        }

        if($chapter != null && $section != null && $classname !== null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\autoTestPaper', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

    /**
     * 将提交的数据保存到数据库中 
     */
    public function store(Request $request)
    {
        //dd($request->record);

        $papers = explode('_', $request->paper);
        //dd($papers);

        for($i=0; $i<count($papers)-1; $i++){
            $paperproblem = new PaperProblem;
            $paperproblem->problem_id = $papers[$i];
            $paperproblem->save();
        }

        if($request->record != 1){
            return redirect('autoTestPaper')->with('status', '已提交');
        }else{
            return redirect('autoTestPaper\usedProblem')->with('status', '已提交');
        }

    }

    /*
    *显示试卷，用于打印
    */
    public function show(Request $request)
    {
        //跳转到组卷页面
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        $judg = array();
        $count = 0;
        $paperproblems = PaperProblem::all();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($paperproblems as $paperproblem){
                if($problem->id == $paperproblem->problem_id){
                    $judg[$count] = $problem->id;
                    $count++;
                    continue;
                }
                else{
                    continue;
                }
            }
        }

        if($chapter != null && $section != null && $classname !== null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblemr', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::where([['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('autoTestPaper\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

}
