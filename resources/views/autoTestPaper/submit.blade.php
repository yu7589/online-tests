@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="get" action="http://localhost/online-tests/public/autoTestPaper/testPaper">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                    预览卷子
            </button>  
            </div>
        </div>
    </form>

    <table id="Tab" class="table table-bordered table-hover">
        <thead>
            <th style="width:60px;">序号</th>
            <th>题目</th>
            <th style="width:120px;">操作</th>
        </thead>
    @foreach ($problemsubmit as $submit)
        @foreach($problems as $problem)
            @if($submit->problem_id == $problem->id)
            <tbody style="background-color:white">
                 <tr>
                    @if($problem->type == 1)
                    <td  name="Sid">{{ $submit->problem_id }}</td>
                    <td  name="Sname">                   
                        {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                        <br>
                        判断题:{{ $problem->stem }}
                        <br>
                    </td>
                    @elseif($problem->type == 2)
                    <td  name="Sid">{{ $submit->problem_id }}</td>
                    <td  name="Sname">                   
                        {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                        <br>
                        选择题:{{ $problem->stem }}
                        <br>
                    </td>
                    @elseif($problem->type == 3)
                    <td  name="Sid">{{ $submit->problem_id }}</td>
                    <td  name="Sname">                   
                        {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                        <br>
                        填空题:{{ $problem->stem }}
                        <br>
                    </td>
                    @else
                    <td  name="Sid">{{ $submit->problem_id }}</td>
                    <td  name="Sname">                   
                        {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                        <br>
                        简答题:{{ $problem->stem }}
                        <br>
                    </td>
                    @endif
                    <td>
                        <div class="container">
                            <div class="row">
                                <!-- delete model -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete" onclick="deleteAnswer({{ $submit->id }})">取消本题</button>
                                <!-- 模态框 -->
                                <form method="post" action="/online-tests/public/autoTestPaper/submit/delete">
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
                                                确定要取消这个问题？
                                            </div>
                                        
                                            <!-- 模态框底部 -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" id="deleteID" name="problem_id" value="">确定</button>
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
    {{ $problemsubmit->links() }} 

@if(session('status'))
    <script>
        alert('{{session('status')}}');
    </script>
@endif
</div>
@endsection

<script>
//将id的值保存在 id="deleteID" 的按钮中，然后传给后台
function deleteAnswer(id){
    $("#deleteID").val(id);
}
</script>






