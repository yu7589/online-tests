@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="post" action="/online-tests/public/problemEdit/delete">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">输入章节进行筛选</span>
                    </div>
                    <input type="text" class="form-control" placeholder="章">
                    <input type="text" class="form-control" placeholder="节">
                </div>
            </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                    确定
            </button>  
            </div>
        </div>
    </form>

    <form method="post" action="/online-tests/public/problemEdit/delete">
    {{ csrf_field() }}
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
                            答案: {{ $problem->answer }}  
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm">编辑</button>
                                &nbsp;&nbsp;
                                <!-- delete -->
                            
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">删除</button>
                             
                                <!-- 模态框 -->
                                <div class="modal fade" id="myModal">
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
                                                <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problem->id }}" >确定</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            答案: {{ str_replace('*', '', $problem->answer) }}
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm">编辑</button>
                                &nbsp;&nbsp;
                                <!-- delete -->
                            
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">删除</button>
                             
                                <!-- 模态框 -->
                                <div class="modal fade" id="myModal">
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
                                                <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problem->id }}" >确定</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            答案: {{ $problem->answer }}  
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm">编辑</button>
                                &nbsp;&nbsp;
                                <!-- delete -->
                            
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">删除</button>
                             
                                <!-- 模态框 -->
                                <div class="modal fade" id="myModal">
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
                                                <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problem->id }}" >确定</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            答案: {{ $problem->answer }}    
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm">编辑</button>
                                &nbsp;&nbsp;
                                <!-- delete -->
                            
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">删除</button>
                             
                                <!-- 模态框 -->
                                <div class="modal fade" id="myModal">
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
                                                <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problem->id }}" >确定</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                 </tr>
            </tbody>
            @endif
        @endforeach
    @endforeach
    </table>
    </form>
    <!-- pagination -->
    {{ $problems->links() }} 
</div>
@endsection