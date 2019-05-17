<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//用户注册登陆系统路由
Auth::routes();

//主页路由
Route::get('/home', 'HomeController@index')->name('home');

//题库页面路由
Route::get('/problems', 'Problems\ProblemsController@index')->name('problems');
Route::post('/problems', 'Problems\ProblemsController@store')->name('problems');
Route::get('/problems/answered','Problems\ProblemsController@show');

//题目提交界面路由
Route::get('/submit', 'Problems\SubmitController@index')->name('submit');
Route::post('/submit/delete', 'Problems\SubmitController@delete');
Route::post('/submit/update', 'Problems\SubmitController@update');

//题库导入界面路由
Route::get('/problemImport', 'ProblemImport\ProblemImportController@index')->name('problemImport');
Route::post('/problemImport/creating', 'ProblemImport\ProblemImportController@creating');
Route::post('/problemImport/upload', 'ProblemImport\ProblemImportController@upload');

//题目编辑界面路由
Route::get('/problemEdit', 'ProblemEdit\ProblemEditController@index')->name('problemEdit');
Route::post('/problemEdit/delete', 'ProblemEdit\ProblemEditController@delete');
Route::post('problemEdit/update', 'ProblemEdit\ProblemEditController@update');

//自动组卷界面路由
Route::get('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@index')->name('autoTestPaper');
Route::get('/autoTestPaper/testPaper', 'AutoTestPaper\AutoTestPaperController@show');
Route::post('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@store')->name('autoTestPaper');

//个人中心界面路由
Route::get('/personalCenter', 'PersonalCenter\PersonalCenterController@index')->name('personalCenter');

//作业布置界面路由
Route::get('/homeworkAssignment', 'HomeworkAssignment\HomeworkAssignmentController@index')->name('homeworkAssignment');

//学生信息导入界面路由
Route::get('/studentInfoImport', 'StudentInfoImport\StudentInfoImportController@index')->name('studentInfoImport');
Route::post('/studentInfoImport/creating', 'StudentInfoImport\StudentInfoImportController@creating');
Route::post('/studentInfoImport/upload', 'StudentInfoImport\StudentInfoImportController@upload');

//作业批改界面路由
Route::get('/homeworkCorrecting', 'HomeworkCorrecting\HomeworkCorrectingController@index')->name('homeworkCorrecting');