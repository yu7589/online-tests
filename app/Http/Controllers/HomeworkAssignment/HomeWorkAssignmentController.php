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

class HomeWorkAssignmentController extends Controller
{
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
