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
Route::post('/problems', 'Problems\ProblemsController@store')->name('problems.store');
Route::get('/answered','Problems\ProblemsController@show')->name('problems.show');
Route::get('/problems_homework','Problems\ProblemsController@showHomework')->name('problems.showHomework');

//题目提交界面路由
Route::get('/submit', 'Problems\SubmitController@index')->name('submit');
Route::post('/submit/delete', 'Problems\SubmitController@delete')->name('submit.delete');
Route::post('/submit/update', 'Problems\SubmitController@update')->name('submit.update');

//题库导入界面路由
Route::get('/problemImport', 'ProblemImport\ProblemImportController@index')->name('problemImport');
Route::post('/problemImport/creating', 'ProblemImport\ProblemImportController@creating')->name('problemImport.creating');
Route::post('/problemImport/upload', 'ProblemImport\ProblemImportController@upload')->name('problemImport.upload');

//学生信息导入界面路由
Route::get('/studentInfoImport', 'StudentInfoImport\StudentInfoImportController@index')->name('studentInfoImport');
Route::post('/studentInfoImport/creating', 'StudentInfoImport\StudentInfoImportController@creating')->name('studentInfoImport.creating');
Route::post('/studentInfoImport/upload', 'StudentInfoImport\StudentInfoImportController@upload')->name('studentInfoImport.upload');

//题目编辑界面路由
Route::get('/problemEdit', 'ProblemEdit\ProblemEditController@index')->name('problemEdit');
Route::post('/problemEdit/delete', 'ProblemEdit\ProblemEditController@delete')->name('problemEdit.delete');
Route::post('problemEdit/update', 'ProblemEdit\ProblemEditController@update')->name('problemEdit.update');

//组卷界面路由
Route::get('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@index')->name('autoTestPaper');
Route::post('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@store')->name('autoTestPaper.store');
Route::get('/autoTestPaper/usedProblem', 'AutoTestPaper\AutoTestPaperController@show')->name('autoTestPaper.show');

//组卷提交界面路由
Route::get('/autoTestPaper/submit', 'AutoTestPaper\PaperSubmitController@index')->name('papersubmit');
Route::post('/autoTestPaper/submit/delete', 'AutoTestPaper\PaperSubmitController@delete')->name('papersubmit.delete');
Route::post('/autoTestPaper/testPaper', 'AutoTestPaper\PaperSubmitController@show')->name('papersubmit.show');
Route::post('/autoTestPaper/deleteAll', 'AutoTestPaper\PaperSubmitController@deleteAll')->name('papersubmit.deleteAll');

//个人中心界面路由
Route::get('/personalCenter', 'PersonalCenter\PersonalCenterController@index')->name('personalCenter');

//作业布置界面路由
Route::get('/homeworkAssignment', 'HomeworkAssignment\HomeworkAssignmentController@index')->name('homeworkAssignment');
Route::post('/homeworkAssignment', 'HomeworkAssignment\HomeworkAssignmentController@store')->name('homeworkAssignment.store');
Route::get('/homeworkAssignment/usedProblem', 'HomeworkAssignment\HomeworkAssignmentController@show')->name('homeworkAssignment.show');


//作业布置提交界面路由
Route::get('/homeworkAssignment/homeworkSubmit', 'HomeworkAssignment\HomeworkSubmitController@index')->name('homeworksubmit');
Route::post('/homeworkAssignment/deleteAll', 'HomeworkAssignment\HomeworkSubmitController@deleteAll')->name('homeworksubmit.deleteAll');
Route::post('/homeworkAssignment/homeworkSubmit/delete', 'HomeworkAssignment\HomeworkSubmitController@delete')->name('homeworksubmit.delete');
Route::post('/homeworkAssignment/homeworkInfo', 'HomeworkAssignment\HomeworkSubmitController@show')->name('homeworksubmit.show');


//作业批改界面路由
Route::get('/homeworkCorrecting', 'HomeworkCorrecting\HomeworkCorrectingController@index')->name('homeworkCorrecting');
Route::post('/homeworkCorrecting/store', 'HomeworkCorrecting\HomeworkCorrectingController@store')->name('homeworkCorrecting.store');