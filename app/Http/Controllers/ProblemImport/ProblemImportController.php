<?php

namespace App\Http\Controllers\ProblemImport;

use App\Problem;
use App\ProblemState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

error_reporting(2);
class ProblemImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('problemImport\problemImport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->QU);
        $count = 0;
        $problems = Problem::all();
        foreach($problems as $data){
            if($data->stem == $request->QU){
                $count = 1;
            }
        }
        if($count = 0){
            $problem = new Problem;
            $problem->chapter = $request->QU;
            $problem->section = $request->QU;
            $problem->stem = $request->QU;
            $problem->picture_url1 = $request->QU;
            $problem->picture_url2 = '';
            $problem->answer = $request->QU;
            $problem->type = $request->QU;
            $problem->difficulty = 1;
            $problem->author = $request->QU;
            $problem->save();
        }
        return view('problemImport\problemImport');
    }

    /**
     * file upload
     */
    public function upload(Request $request){
        
        //dd("a");
    	if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的
    		//查看上传文件的属性
            $fileCharacter = $request->file('source');
            

            //dd(explode("\n",$fileCharacter->get()));
            //将题库文件按分行符划分为数组保存到problems中
            $newProblems = explode("\n",$fileCharacter->get());
            //dd($newProblems);
            $chapter = null;
            $section = null;
            $stem = null;
            $picture_url1 = null;
            $picture_url2 = null;
            $answer = null;
            $explanation = null;
            $type = null;
            $difficulty = null;
            $author = null;
            $used = null;
            $CO = null;

            $count = 0;
            for($i=0; $i<count($newProblems)-1; $i++){
                switch($count){
                    case 0:
                        $stem = ltrim($newProblems[$i], "QU - ");
                        //dd($stem);
                        $count++;
                        break;
                    case 1:
                        $answer = ltrim($newProblems[$i], "SO - ");
                        //dd($answer);
                        $count++;
                        break;
                    case 2:
                        $picture_url1 = ltrim($newProblems[$i], "QF - ");
                        //dd($picture_url1);
                        $count++;
                        break;
                    case 3:
                        $picture_url2 = ltrim($newProblems[$i], "SF - ");
                        //dd($picture_url2);
                        $count++;
                        break;
                    case 4:
                        $explanation = ltrim($newProblems[$i], "AN - ");
                        $count++;
                        break;
                    case 5:
                        $CO = $newProblems[$i];
                        //dd($CO);
                        $count++;

                        $cut = explode("-", $CO);
                        //dd($cut);
                        $chapter = ltrim($cut[1]);
                        $section = $cut[2];
                        $type = $cut[4];
                        $difficulty = $cut[5];
                        $author = $cut[6];
                        $used = $cut[8];
                        if($used == 'usd'){
                            $used = 1;
                        }else {
                            $used = 0;
                        }
                        

                        //插入新题目
                        $problem = new Problem;
                        $problem->chapter = $chapter;
                        $problem->section = $section;
                        $problem->stem = $stem;
                        $problem->picture_url1 = $picture_url1;
                        $problem->picture_url2 = $picture_url2;
                        $problem->answer = $answer;
                        $problem->explanation = $explanation;
                        $problem->type = $type;
                        $problem->difficulty = $difficulty;
                        $problem->author = $author;
                        $problem->used = $used;
                        $problem->save();

                        //
                        $problems = Problem::where('stem',$stem)->get();
                        //dd(count($problems));
                        foreach($problems as $problem){
                            //dd($problem->stem);
                            $problemState = new ProblemState;
                            $problemState->problem_id = $problem->id;
                            //dd($problemState->problem_id);
                            $problemState->correct_submit = 0;
                            $problemState->passing_rate = 0;
                            $problemState->all_submit = 0;
                            $problemState->save();
                        }

                        break;
                    case 6:
                        $count = 0;
                        break;
                    default:
                        break;
                }
            }

    		if ($fileCharacter->isValid()) { 
    			//获取文件的扩展名 
    			$ext = $fileCharacter->getClientOriginalExtension();
 
    			//获取文件的绝对路径
    			$path = $fileCharacter->getRealPath();
 
    			//定义文件名
    			$filename = $fileCharacter->getClientOriginalName();
 
    			//存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
    			Storage::disk('public')->put($filename, file_get_contents($path));
            }
        }


        return redirect('problemImport');
    }
}