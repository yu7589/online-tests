@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="post" action="/online-tests/public/problemEdit/display">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                    确定提交
            </button>  
            </div>
        </div>
    </form>

    <table id="Tab" class="table table-bordered table-hover">
        <thead>
            <th style="width:60px;">序号</th>
            <th>题目</th>
            <th style="width:80px;">操作</th>
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
                    </td>
                    <!-- 类型2为选择题 -->
                    @elseif($problem->type==2)
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            选择题:{{ $problem->stem }}
                        <br>
                    </td>
                    <!-- 类型3为填空题 -->
                    @elseif($problem->type==3)
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            填空题:{{ $problem->stem }}
                        <br>
                    </td>
                    <!-- 类型4 为简答题 -->
                    @else
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            简答题:{{ $problem->stem }}
                        <br>
                    </td>
                    @endif
                    <td>
                        <div class="container">
                            <div class="row">
                                <!-- delete model -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" onclick="values({{ $problem->id }})">删除</button>
                                <!-- 模态框 -->
                                <form method="post" action="/online-tests/public/problemEdit/delete">
                                {{ csrf_field() }}
                                <div class="modal fade" id="delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- 模态框头部 -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">请确认</h4>
                                            </div>
                                        
                                            <!-- 模态框主体 -->
                                            <div class="modal-body">
                                                确定要删除这个问题？
                                            </div>
                                        
                                            <!-- 模态框底部 -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" id="deleteID" name="problem_id" value="" >确定</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </td>
                 </tr>
            </tbody>
            @endif
        @endforeach
    @endforeach
    </table>
    @if(session('status'))
        <script>
            alert('{{session('status')}}');
        </script>
    @endif
</div>
@endsection






