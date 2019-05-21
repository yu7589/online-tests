<?php

namespace App\Http\Controllers\Problems;

use App\User;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use App\ProblemSubmit;
use App\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProblemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //跳转到题库页面
        $student_number = $request->user()->student_number;
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        //用于显示已完成的题目
        $judg = array();
        $count = 0;
        $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($problemComplete as $complete){
                if($problem->id == $complete->problem_id){
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
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\problems', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

    /**
     * 将提交的数据保存到problemsubmit数据库中 
     */
    public function store(Request $request)
    {
        //dd($request->user()->student_number);
        $problems = Problem::all();
        $submits = ProblemSubmit::all();

        $answers = explode('_', $request->answer);
        //dd($answers[0]);
        for($i=0; $i<count($answers)-2; $i=$i+2){
            foreach($submits as $submit){
                if($submit->problem_id == $answers[$i]){
                    return redirect('problems')->with('status', '部分问题已提交过，不要重复提交');
                }
            }
            foreach($problems as $problem){
                if($problem->id == $answers[$i]){
                    $problemsubmit = new ProblemSubmit;
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

        return redirect('problems')->with('status', '已提交');
    }

    public function show(Request $request)
    {
        //跳转到已做答题目题库页面
        $student_number = $request->user()->student_number;
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }

        /*
        *查询problem和problemcomplete中都存在的problem_id，保存在数组$judg中
        */
        $judg = array();
        $count = 0;
        $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($problemComplete as $complete){
                if($problem->id == $complete->problem_id){
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
            $problemComplete = ProblemComplete::where([['classname', '=', $classname], ['chapter', '=', $chapter], ['section', '=', $section]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problemComplete = ProblemComplete::where([['chapter', '=', $chapter], ['section', '=', $section]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problemComplete = ProblemComplete::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problemComplete = ProblemComplete::where([['classname', '=', $classname], ['section', '=', $section]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problemComplete = ProblemComplete::where([['chapter', '=', $chapter]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problemComplete = ProblemComplete::where([['section', '=', $section]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problemComplete = ProblemComplete::where([['classname', '=', $classname]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->whereIn('problem_id', $judg)->paginate($pageNumber);
            $problems = Problem::all();
            $problemstates = ProblemState::all();
            return view('problems\answered', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

    public function showHomework(Request $request)
    {
        //跳转到作业题库页面
        $student_number = $request->user()->student_number;
        $classname = $request->input('classname');
        $chapter = $request->input('chapter');
        $section = $request->input('section');
        $pageNumber = 10;
        if($request->input('pageNumber') != null){
            $pageNumber = $request->input('pageNumber');
        }


        $homeworks = Homework::all();
        //用于显示已完成的题目
        $judg = array();
        $count = 0;
        $problemComplete = ProblemComplete::where([['student_number', '=', $student_number]])->get();
        $problems = Problem::all();
        foreach($problems as $problem){
            foreach($problemComplete as $complete){
                if($problem->id == $complete->problem_id){
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
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section != null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname], ['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter != null && $section == null && $classname == null){
            $problems = Problem::where([['chapter', '=', $chapter]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section != null && $classname == null){
            $problems = Problem::where([['section', '=', $section]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }else if($chapter == null && $section == null && $classname != null){
            $problems = Problem::where([['classname', '=', $classname]])->whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
        else {
            //dd($problemComplete[0]->student_number);
            $problems = Problem::whereNotIn('id', $judg)->paginate($pageNumber);
            $problemstates = ProblemState::all();
            return view('problems\homework', ['problems'=>$problems, 'problemstates'=>$problemstates, 'problemcomplete'=>$problemComplete, 'classname'=>$classname, 'chapter'=>$chapter, 'section'=>$section, 'pageNumber'=>$pageNumber]);
        }
    }

}
