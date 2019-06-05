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
Route::get('/problemImport', 'ProblemImport\ProblemImportController@index')->name('problemImport')->middleware('Identity');
Route::post('/problemImport/creating', 'ProblemImport\ProblemImportController@creating')->name('problemImport.creating')->middleware('Identity');
Route::post('/problemImport/upload', 'ProblemImport\ProblemImportController@upload')->name('problemImport.upload')->middleware('Identity');

//学生信息导入界面路由
Route::get('/studentInfoImport', 'StudentInfoImport\StudentInfoImportController@index')->name('studentInfoImport')->middleware('Identity');
Route::post('/studentInfoImport/creating', 'StudentInfoImport\StudentInfoImportController@creating')->name('studentInfoImport.creating')->middleware('Identity');
Route::post('/studentInfoImport/upload', 'StudentInfoImport\StudentInfoImportController@upload')->name('studentInfoImport.upload')->middleware('Identity');

//题目编辑界面路由
Route::get('/problemEdit', 'ProblemEdit\ProblemEditController@index')->name('problemEdit')->middleware('Identity');
Route::post('/problemEdit/delete', 'ProblemEdit\ProblemEditController@delete')->name('problemEdit.delete')->middleware('Identity');
Route::post('problemEdit/update', 'ProblemEdit\ProblemEditController@update')->name('problemEdit.update')->middleware('Identity');

//组卷界面路由
Route::get('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@index')->name('autoTestPaper')->middleware('Identity');
Route::post('/autoTestPaper', 'AutoTestPaper\AutoTestPaperController@store')->name('autoTestPaper.store')->middleware('Identity');
Route::get('/autoTestPaper/usedProblem', 'AutoTestPaper\AutoTestPaperController@show')->name('autoTestPaper.show')->middleware('Identity');

//组卷提交界面路由
Route::get('/autoTestPaper/submit', 'AutoTestPaper\PaperSubmitController@index')->name('papersubmit')->middleware('Identity');
Route::post('/autoTestPaper/submit/delete', 'AutoTestPaper\PaperSubmitController@delete')->name('papersubmit.delete')->middleware('Identity');
Route::post('/autoTestPaper/testPaper', 'AutoTestPaper\PaperSubmitController@show')->name('papersubmit.show')->middleware('Identity');
Route::post('/autoTestPaper/deleteAll', 'AutoTestPaper\PaperSubmitController@deleteAll')->name('papersubmit.deleteAll')->middleware('Identity');

//个人中心界面路由
Route::get('/personalCenter', 'PersonalCenter\PersonalCenterController@index')->name('personalCenter');

//作业布置界面路由
Route::get('/homeworkAssignment', 'HomeworkAssignment\HomeworkAssignmentController@index')->name('homeworkAssignment')->middleware('Identity');
Route::post('/homeworkAssignment', 'HomeworkAssignment\HomeworkAssignmentController@store')->name('homeworkAssignment.store')->middleware('Identity');
Route::get('/homeworkAssignment/usedProblem', 'HomeworkAssignment\HomeworkAssignmentController@show')->name('homeworkAssignment.show')->middleware('Identity');


//作业布置提交界面路由
Route::get('/homeworkAssignment/homeworkSubmit', 'HomeworkAssignment\HomeworkSubmitController@index')->name('homeworksubmit')->middleware('Identity');
Route::post('/homeworkAssignment/deleteAll', 'HomeworkAssignment\HomeworkSubmitController@deleteAll')->name('homeworksubmit.deleteAll')->middleware('Identity');
Route::post('/homeworkAssignment/homeworkSubmit/delete', 'HomeworkAssignment\HomeworkSubmitController@delete')->name('homeworksubmit.delete')->middleware('Identity');
Route::post('/homeworkAssignment/homeworkInfo', 'HomeworkAssignment\HomeworkSubmitController@show')->name('homeworksubmit.show')->middleware('Identity');


//作业批改界面路由
Route::get('/homeworkCorrecting', 'HomeworkCorrecting\HomeworkCorrectingController@index')->name('homeworkCorrecting')->middleware('Identity');
Route::post('/homeworkCorrecting/store', 'HomeworkCorrecting\HomeworkCorrectingController@store')->name('homeworkCorrecting.store')->middleware('Identity');