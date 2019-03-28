<?php

namespace App\Http\Controllers\ProblemImport;

use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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

    	if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的
    		//查看上传文件的属性
    		$fileCharater = $request->file('source');
 
    		if ($fileCharater->isValid()) { 
    			//获取文件的扩展名 
    			$ext = $fileCharater->getClientOriginalExtension();
 
    			//获取文件的绝对路径
    			$path = $fileCharater->getRealPath();
 
    			//定义文件名
    			$filename = date('Y-m-d-h-i-s').'.'.$ext;
 
    			//存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
    			Storage::disk('public')->put($filename, file_get_contents($path));
            }
        }
        return redirect('problemImport');
    }
}