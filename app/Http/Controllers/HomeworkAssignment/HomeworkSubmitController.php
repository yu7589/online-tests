<?php

namespace App\Http\Controllers\HomeworkAssignment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Problem;
use App\ProblemState;
use App\ProblemComplete;
use Illuminate\Support\Facades\DB;
use App\PaperProblem;
use App\User;
use App\ProblemSubmit;
use App\Homework;

class HomeworkSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $homeworksubmit = Homework::where([['times', '=', 0]])->paginate(10);
        $problems = Problem::all();
        return view('homeworkAssignment/homeworkSubmit', ['homeworksubmit'=>$homeworksubmit, 'problems'=>$problems]);
    }

    public function delete(Request $request)
    {
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        //dd($request->problem_id);
        $data = Homework::find($request->problem_id)->Delete();
        return redirect('homeworkAssignment/homeworkSubmit')->with('status', '取消成功');
    }

    public function show(Request $request)
    {
        //
        $times = $request->times;
        $course = $request->course;
        $endtime = $request->endtime;

        $homeworks = Homework::all();
        foreach($homeworks as $homework){
            if($homework->classname == 0 && $homework->times == 0){
                $homework->times = $times;
                $homework->classname =$course;
                $homework->endtime = $endtime;
                $homework->save();
            }else{
                continue;
            }
        }

        return redirect('homeworkAssignment/homeworkSubmit')->with('status', '布置作业成功');
    }

    public function deleteAll(Request $request)
    {
        //DB::table('problems')->where('id', '=', $request->problem_id)->delete();
        //dd(1);
        $datas = Homework::all();
        foreach($datas as $data){
            $data->delete();
        } 
        return redirect('homeworkAssignment/homeworkSubmit')->with('status', '取消成功');
    }
}
