<?php

namespace App\Http\Controllers\HomeworkAssignment;


use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaperProblem;
use App\User;
use App\ProblemSubmit;
use App\Homework;

class HomeWorkAssignmentController extends Controller
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
        //跳转到布置作业页面
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        $judg = array();
        $count = 0;
        $homeworks = HomeWork::all();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($homeworks as $homework){
                if($problem->id == $homework->problem_id){
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
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\homeworkAssignment', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
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
        $homeworks = explode('_', $request->homework);
        //dd($homeworks);

        for($i=0; $i<count($homeworks)-1; $i++){
            $homeworkproblem = new Homework;
            $homeworkproblem->problem_id = $homeworks[$i];
            $homeworkproblem->times = 0;
            $homeworkproblem->classname = 0;
            $homeworkproblem->endtime = '2008-12-29';
            $homeworkproblem->save();
        }

        if($request->record != 1){
            return redirect('homeworkAssignment')->with('status', '已提交');
        }else{
            return redirect('homeworkAssignment\usedProblem')->with('status', '已提交');
        }
    }

    public function show(Request $request)
    {
        //跳转到作业布置中重点题目页面
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        $judg = array();
        $count = 0;
        $homeworks = HomeWork::all();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($homeworks as $homework){
                if($problem->id == $homework->problem_id){
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
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblemr', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::where([['used', '=', 1]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('homeworkAssignment\usedProblem', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
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
