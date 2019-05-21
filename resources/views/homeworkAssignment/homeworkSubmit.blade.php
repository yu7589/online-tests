@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit">
                        自定义作业信息
                </button>  
            </div>
                <form method="post" action="http://localhost/online-tests/public/homeworkAssignment/homeworkInfo">
                {{ csrf_field() }}
                    <div class="modal fade" id="edit">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- 模态框头部 -->
                                <div class="modal-header">
                                    <h4 class="modal-title">请确认</h4>
                                </div>
                            
                                <!-- 模态框主体 -->
                                <div class="modal-body">
                                    <label class="text-center">题目修改</label>
                                        <div class="form-group">
                                            <label for="lastname" class="col-sm-2 control-label">第几次作业</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="times" name="times" value='' placeholder="请输入次数(1 或 2 或 ...)" required="required">
                                            </div>
                                        </div>     
                                        <div class="form-group">
                                            <label for="lastname" class="col-sm-2 control-label">课程</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="course" name="course" value='' placeholder="请输入课程" required="required">
                                            </div>
                                        </div>                                                                    
                                        <div class="form-group">
                                            <label for="lastname" class="col-sm-2 control-label">截止时间</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="endtime" name="endtime" value='' placeholder="请输入截止时间（格式 2011-1-1）" required="required">
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- 模态框底部 -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" id="editID" name="problem_id" value="" >确定</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAll">取消所有题目</button>
                <form method="post" action="http://localhost/online-tests/public/homeworkAssignment/deleteAll">
                {{ csrf_field() }}
                <div class="modal fade" id="deleteAll">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- 模态框头部 -->
                            <div class="modal-header">
                                <h4 class="modal-title">请确认</h4>
                            </div>
                        
                            <!-- 模态框主体 -->
                            <div class="modal-body">
                                确定要删除这些问题？
                            </div>
                        
                            <!-- 模态框底部 -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="problem_id" value="" >确定</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <table id="Tab" class="table table-bordered table-hover">
        <thead>
            <th style="width:60px;">序号</th>
            <th>题目</th>
            <th style="width:120px;">操作</th>
        </thead>
    @foreach ($homeworksubmit as $submit)
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
                                <form method="post" action="/online-tests/public/homeworkAssignment/homeworkSubmit/delete">
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
    {{ $homeworksubmit->links() }} 

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






