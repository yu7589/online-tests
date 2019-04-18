@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-8">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            全部题目 
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/online-tests/public/problems/1">全部题目</a>
                            <a class="dropdown-item" href="/online-tests/public/problems/2">已通过题目</a>
                            <a class="dropdown-item" href="/online-tests/public/problems/3">未通过题目</a>
                        </div>
                    </span>
                    <!-- | 分隔符 -->
                    <span class="border-right mr-2">
                    </span>

                    <span class="text-success mt-1 " style="font-size:19px"> 
                        默认排序
                    </span>
                    <span class="mt-1 ml-3" style="font-size:19px"> 
                        难度排序
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="col-md-4">
                    <div class="input-group ">
                        <button type="button" class="btn btn-success">已选中题目</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 题目 -->
        <div style="width:860px;float:left;">
            <table id="Tab" class="table table-bordered table-hover">
                <thead>
                        <th>                                
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">
                                </label>
                            </div>
                        </th>
                        <th style="width:60px;">序号</th>
                        <th>题目</th>
                        <th style="width:120px;"></th>
                </thead>
            @foreach ($problems as $problem)
                @foreach ($problemstates as $problemstate)
                    @if($problem->id == $problemstate->problem_id)
                    <tbody style="background-color:#fff;">
                         <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">
                                    </label>
                                </div>
                            </td>
                            <!-- type=1 为判断题 -->
                            @if($problem->type==1)
                            <td  name="Sid">{{ $problem->id }}</td>
                            <td  name="Sname">                   
                                    第{{ $problem->chapter }}章第{{ $problem->section }}节
                                    <br>
                                    判断题:{{ $problem->stem }}
                                <br>
                                <br>
                                <form method="post" action="/online-tests/public/problems">
                                {{ csrf_field() }}
                                    答案:
                                    <div class="row">
                                        <div class="radio radio-inline">
                                            <input type="radio" name="radio1" id="radio1" value="option1">
                                            <label for="radio1">
                                                T
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" name="radio1" id="radio2" value="option2">
                                            <label for="radio2">
                                                F
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <!-- 类型2为选择题 -->
                            @elseif($problem->type==2)
                            <td  name="Sid">{{ $problem->id }}</td>
                            <td  name="Sname">                   
                                    第{{ $problem->chapter }}章第{{ $problem->section }}节
                                    <br>
                                    选择题:{{ $problem->stem }}
                                <br>
                                <br>
                                <form method="post" action="/online-tests/public/problems">
                                {{ csrf_field() }}
                                    答案:
                                    {{ str_replace('*', '', $problem->answer) }}
                                </form>
                            </td>
                            <!-- 类型3为填空题 -->
                            @elseif($problem->type==3)
                            <td  name="Sid">{{ $problem->id }}</td>
                            <td  name="Sname">                   
                                    第{{ $problem->chapter }}章第{{ $problem->section }}节
                                    <br>
                                    填空题:{{ $problem->stem }}
                                    <br>
                                    {{ $problem->answer }}
                                <br>
                                <br>
                                <form method="post" action="/online-tests/public/problems">
                                {{ csrf_field() }}
                                    答案:
                                    <div class="input-group" style="width:280px;">
                                        <input type="text" class="form-control" name="answer">
                                    </div>
                                </form>
                            </td>
                            <!-- 类型4 为简答题 -->
                            @else
                            <td  name="Sid">{{ $problem->id }}</td>
                            <td  name="Sname">                   
                                    第{{ $problem->chapter }}章第{{ $problem->section }}节
                                    <br>
                                    简答题:{{ $problem->stem }}
                                <br>
                                <br>
                                <form method="post" action="/online-tests/public/problems">
                                {{ csrf_field() }}
                                答案:            
                                <div class="input-group col-md-10">
                                    <textarea class="form-control" rows="3" type="text" name="answer"></textarea>
    
                                </div>
                                </form>
                            </td>
                            @endif
                            <td>
                                通过率：{{ $problemstate->passing_rate }} 
                                <br>
                                正确提交：{{ $problemstate->correct_submit }} 
                                <br>
                                总提交：{{ $problemstate->all_submit }}
                            </td>
                         </tr>
                    </tbody>
                    @endif
                @endforeach
            @endforeach
            </table>
            <!-- pagination -->
            {{ $problems->links() }}
        </div>

        <!-- 筛选 -->
        <div style="hight:1000px">
            <div class="card" style="width:240px;float:right;margin-left:40px;margin-top:45px;">
                <div class="card-body">
                    筛选
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>                    <br>
                    <br>
                    占位
                </div>
            </div>
        </div>
    <div>
</div>
@endsection