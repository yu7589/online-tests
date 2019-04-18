@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
  
    <div class="row">
        <div class="col-md-8">
        <form>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">输入章节进行筛选</span>
            </div>
            <input type="text" class="form-control" placeholder="章">
            <input type="text" class="form-control" placeholder="节">
            </div>
        </form>
        </div>
        <div class="col-md-2">
        <button class="btn btn-success">
                确定
        </button>  
        </div>
    </div>
  

 
    <table id="Tab" class="table table-bordered table-hover">
        <thead>
            <th style="width:60px;">序号</th>
            <th>题目</th>
            <th style="width:120px;">操作</th>
        </thead>
    @foreach ($problems as $problem)
        @foreach ($problemstates as $problemstate)
            @if($problem->id == $problemstate->problem_id)
            <tbody style="background-color:white">
                 <tr>
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
                            答案: {{ $problem->answer }}  
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
                            答案: {{ str_replace('*', '', $problem->answer) }}
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
                            答案: {{ $problem->answer }}  
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
                            答案: {{ $problem->answer }}    
                        </form>
                    </td>
                    @endif
                    <td>
                        <div class="container">
                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm">编辑</button>
                                &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger btn-sm">删除</button>
                            </div>
                        </div>
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
@endsection