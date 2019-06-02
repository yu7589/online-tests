<?php

namespace App\Http\Controllers\ProblemEdit;

use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use EndaEditor;

class ProblemEditController extends Controller
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
        //
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');

        if($chapter != null && $section != null && $classname !== null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['section', '=', $section]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname]])->paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::paginate(10);
            $problemstates = ProblemState::all();
            return view('problemEdit/problemEdit', ['problems'=>$problems, 'problemstates'=>$problemstates, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section]);
        }
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
        //dd($request->classnametext);
        $problem = Problem::find($request->problem_id);
        $problem->classname = $request->classnametext;
        $problem->chapter = $request->chaptertext;
        $problem->section = $request->sectiontext;
        $problem->stem = $request->stem;
        $problem->answer = $request->answer;
        $problem->picture_url1 = $request->picture_url1;
        $problem->picture_url2 = $request->picture_url2;
        $problem->explanation = $request->explanation;
        $problem->type = $request->type;
        $problem->author = $request->author;
        $problem->difficulty = $request->difficulty;
        $problem->save();
        return redirect('problemEdit')->with('status', '修改成功');
    }

    public function delete(Request $request)
    {
        //dd($request->problem_id);
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        $data = Problem::find($request->problem_id)->Delete();
        return redirect('problemEdit')->with('status', '删除成功');
    }
}
