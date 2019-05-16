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
    public function creating(Request $request)
    {
        //dd($request->QU);
        $problems = Problem::all();
        foreach($problems as $data){
            if($data->stem == $request->stem){
                return redirect('problemImport')->with('status', '题库中已有此题目');
            }
        }
        $problem = new Problem;
        $problem->chapter = $request->chapter;
        $problem->section = $request->section;
        $problem->stem = $request->stem;
        if($request->picture_url1 == null){
            $request->picture_url1='';
        }
        if($request->picture_url2 == null){
            $request->picture_url2='';
        }
        if($request->author == null){
            $request->author='';
        }
        $problem->picture_url1 = $request->picture_url1;
        $problem->picture_url2 = $request->picture_url2;
        $problem->explanation = $request->explanation;
        $problem->answer = $request->answer;
        $problem->type = $request->type;
        $problem->difficulty = $request->difficulty;
        $problem->author = $request->author;
        $problem->used = $request->USD;
        $problem->save();
        return redirect('problemImport')->with('status', '添加成功');
    }

    /**
     * file upload
     */
    public function upload(Request $request){
        
        //dd("a");
    	if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的
    		//查看上传文件的属性
            $fileCharacter = $request->file('source');
            
            $str = " ";
            $str = str_replace(array("QU -", "SO -", "QF -", "SF -", "AN -", "CO -"), "SPLIT", $fileCharacter->get());
            //dd($str);
            //dd(explode("\n",$fileCharacter->get()));
            //将题库文件按分行符划分为数组保存到problems中
            //$newProblems = explode("\n",$fileCharacter->get());
            $newProblems = explode("SPLIT",$str);
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

            $count = 1;
            for($i=1; $i<count($newProblems); $i++){
                switch($count){
                    case 1:
                        $stem = trim($newProblems[$i]);
                        //dd($stem);
                        $count++;
                        break;
                    case 2:
                        $answer = trim($newProblems[$i]);
                        //dd($answer);
                        $count++;
                        break;
                    case 3:
                        $picture_url1 = trim($newProblems[$i]);
                        //dd($picture_url1);
                        $count++;
                        break;
                    case 4:
                        $picture_url2 = trim($newProblems[$i]);
                        //dd($picture_url2);
                        $count++;
                        break;
                    case 5:
                        $explanation = trim($newProblems[$i]);
                        //dd($explanation);
                        $count++;
                        break;
                    case 6:
                        $CO = trim($newProblems[$i]);
                        $count = 1;
                        //dd($CO);

                        $cut = explode("-", $CO);
                        //dd($cut);
                        $chapter = $cut[0];
                        //dd($chapter);
                        $section = $cut[1];
                        //dd($section);
                        $type = $cut[3];
                        $difficulty = $cut[4];
                        $author = $cut[5];
                        $used = $cut[7];
                        if($used){
                            $used = 1;
                        }else {
                            $used = 0;
                        }
                        //dd($used);
                        

                        //插入新题目
                        $problem = new Problem;
                        $problem->chapter = $chapter;
                        //dd($chapter);
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
                        break;
                    default:
                        break;
                }
            }

            /*
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
            */
        }

        $problems = Problem::all();
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
        return redirect('problemImport')->with('status', '添加成功');
    }
}