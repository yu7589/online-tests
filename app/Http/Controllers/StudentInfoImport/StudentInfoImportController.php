<?php

namespace App\Http\Controllers\StudentInfoImport;

use App\User;
use App\Problem;
use App\VerifyUser;
use App\ProblemState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class StudentInfoImportController extends Controller
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
    public function index()
    {
        //
        return view('studentInfoImport\studentInfoImport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function creating(Request $request)
    {
        //dd($request->class);
        $users = User::all();
        foreach($users as $user){
            if($request->student_number == $user->student_number){
                return redirect('studentInfoImport')->with('status', '数据库中已有此学生信息');
            }
        }

        $verifyuser = new VerifyUser;
        $verifyuser->number = $request->student_number;
        $verifyuser->name = $request->name;
        $verifyuser->class = $request->class;
        $verifyuser->identity = 'student';
        $verifyuser->save();
        return redirect('studentInfoImport')->with('status', '添加成功');
    }

    /**
     * file upload
     */
    public function upload(Request $request){
        
        //dd($request->class);

    	if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的
            //查看上传文件的属性
            $fileCharacter = $request->file('source');
            if ($fileCharacter->isValid()) { 
    			//获取文件的扩展名 
                $ext = $fileCharacter->getClientOriginalExtension();
                
                if($ext == 'csv'){
                    $str = " ";
                    $str = $fileCharacter->get();
                    //dd(explode("\n",$fileCharacter->get()));
                    //将题库文件按分行符划分为数组保存到problems中
                    $data = explode("\n", $str);
                    //dd($data);

                    for($i=1; $i<count($data)-1; $i++){
                        //dd(explode(",", $data[$i]));
                        $newstudent = explode(",", $data[$i]);

                        $verifyuser = new VerifyUser;
                        //dd($newstudent[1]);
                        $verifyuser->number = $newstudent[0];
                        $verifyuser->name = $newstudent[1];
                        $verifyuser->class = $newstudent[2];
                        $verifyuser->identity = 'student';
                        $verifyuser->save();
                    }
                    $student = null;
                    $section = null;
                    $stem = null;

                         
                }
                else{
                    return redirect('studentInfoImport')->with('status', '请上传csv格式的文件');
                }
            }
        }
        return redirect('studentInfoImport')->with('status', '添加成功');
    }
}