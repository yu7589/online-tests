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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//题库页面路由
Route::get('/problems', 'Problems\ProblemsController@index')->name('problems');
Route::post('/problems', 'Problems\ProblemsController@store')->name('problems');
Route::get('/problems/{id}','Problems\ProblemsController@show');

//题库导入界面路由
Route::get('/problemImport', 'ProblemImport\ProblemImportController@index')->name('problemImport');
Route::post('/problemImport', 'ProblemImport\ProblemImportController@store')->name('problemImport');
Route::post('/problemImport/upload', 'ProblemImport\ProblemImportController@upload');