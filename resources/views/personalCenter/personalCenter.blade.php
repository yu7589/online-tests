@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row col-md-12">
        <div class="panel panel-default col-md-12">
            <div class="panel-heading">
                <div class="card">
                <div class="card-header">账户信息</div>
                <div class="card-body">
                    学号：{{ Auth::user()->student_number }}
                    <br>
                    姓名：{{ Auth::user()->name }}
                    <br>
                    邮箱：{{ Auth::user()->email }}
                </div> 
            </div>
            <br>
            <div class="panel-heading">
                <div class="card">
                <div class="card-header">答题情况</div>
                <div class="card-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>题型</th>
                                <th>答题数</th>
                                <th>正确数</th>
                                <th>通过率</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>选择题</td>
                                <td>{{ $state[3] }}</td>
                                <td>{{ $state[4] }}</td>
                                <td>{{ $state[5] }}</td>
                            </tr>
                            <tr>
                                <td>填空题</td>
                                <td>{{ $state[6] }}</td>
                                <td>{{ $state[7] }}</td>
                                <td>{{ $state[8] }}</td>
                            </tr>
                            <tr>
                                <td>判断题</td>
                                <td>{{ $state[0] }}</td>
                                <td>{{ $state[1] }}</td>
                                <td>{{ $state[2] }}</td>
                            </tr>
                            <tr>
                                <td>简答题</td>
                                <td>{{ $state[9] }}</td>
                                <td>{{ $state[10] }}</td>
                                <td>{{ $state[11] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
