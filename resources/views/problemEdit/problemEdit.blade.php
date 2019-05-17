@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="get" action="/online-tests/public/problemEdit">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">输入课程信息进行筛选</span>
                    </div>
                    <input type="text" name=classname id="classname" value="{{ $classname }}" class="form-control" placeholder="课程名">
                    <input type="text" id="chapter" value="{{ $chapter }}" name=chapter class="form-control" placeholder="章">
                    <input type="text" id="section" value="{{ $section }}" name=section class="form-control" placeholder="节">
                </div>
            </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-success">
                    确定
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
    @foreach ($problems as $problem)
        @foreach ($problemstates as $problemstate)
            @if($problem->id == $problemstate->problem_id)
            <tbody style="background-color:white">
                 <tr>
                    <!-- type=1 为判断题 -->
                    @if($problem->type==1)
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            判断题:{{ $problem->stem }}
                        <br>
                            答案: {{ $problem->answer }}  
                        <br>题目图片：<?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br>答案图片：<?php echo EndaEditor::MarkDecode($problem->picture_url2)  ?>
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <!-- 类型2为选择题 -->
                    @elseif($problem->type==2)
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            选择题:{{ $problem->stem }}
                        <br>
                        <br>
                            答案: {{ str_replace('*', '', $problem->answer) }}
                        <br>题目图片：<?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br>答案图片：<?php echo EndaEditor::MarkDecode($problem->picture_url2)  ?>
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <!-- 类型3为填空题 -->
                    @elseif($problem->type==3)
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            填空题:{{ $problem->stem }}
                        <br>
                        <br>
                            答案: {{ $problem->answer }}  
                        <br>题目图片：<?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br>答案图片：<?php echo EndaEditor::MarkDecode($problem->picture_url2)  ?>
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    <!-- 类型4 为简答题 -->
                    @else
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            简答题:{{ $problem->stem }}
                        <br>
                        <br>
                            答案: {{ $problem->answer }}    
                        <br>题目图片：<?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br>答案图片：<?php echo EndaEditor::MarkDecode($problem->picture_url2)  ?>
                        <br>解释：{{ $problem->explanation }}
                        <br>类型：{{ $problem->type }}
                        <br>难度：{{ $problem->difficulty }}
                        <br>作者：{{ $problem->author }}
                    </td>
                    @endif
                    <td>
                        <div class="container">
                            <div class="row">
                                <!-- edit model -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit" onclick="editValue({{ $problem->id }}, '{{ $problem->classname }}', {{ $problem->chapter }}, {{ $problem->section }},
                                '{{ $problem->stem }}', '{{ $problem->answer }}', '{{ $problem->picture_url1 }}', '{{ $problem->picture_url2 }}', '{{ $problem->explanation }}', {{ $problem->type }}, {{ $problem->difficulty }},
                                '{{ $problem->author }}')">编辑</button>
                                <form method="post" action="/online-tests/public/problemEdit/update">
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
                                                        <label for="firstname" class="col-sm-2 control-label">课程名</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="classnametext" name="classnametext" value='' placeholder="请输入课程名" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="firstname" class="col-sm-2 control-label">章</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="chaptertext" name="chaptertext" value='' placeholder="请输入章" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="firstname" class="col-sm-2 control-label">节</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="sectiontext" name="sectiontext" value='' placeholder="请输入节" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="firstname" class="col-sm-2 control-label">题干</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="stem" name="stem" value='' placeholder="请输入题干" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">答案</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="answer" name="answer" value='' placeholder="请输入答案" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">题目图片</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="picture_url1" name="picture_url1" value='' placeholder="请输入题目图片">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">答案图片</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="picture_url2" name="picture_url2" value='' placeholder="请输入答案图片">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">解答</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="explanation" name="explanation" value='' placeholder="请输入解答" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">类型</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="type" name="type" value='' placeholder="请输入题目类型" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">难度</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="difficulty" name="difficulty" value='' placeholder="请输入题目难度" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname" class="col-sm-2 control-label">作者</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="author" name="author" value='' placeholder="请输入题目作者" required="required">
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
                                &nbsp;&nbsp;
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
    <!-- pagination -->
    {!! $problems->appends(['chapter'=>$chapter, 'section'=>$section, 'classname'=>$classname])->links() !!}
</div>
@endsection

<script>
//将id的值保存在 id="deleteID" 的按钮中，然后传给后台
function values(id){
    $("#deleteID").val(id);
}
function editValue(id, classname, chapter, section, stem, answer, picture_url1, picture_url2, explanation, type, difficulty, author){
    $("#editID").val(id);
    $("#classnametext").val(classname);
    $("#chaptertext").val(chapter);
    $("#sectiontext").val(section);
    $("#stem").val(stem);
    $("#answer").val(answer);
    $("#picture_url1").val(picture_url1);
    $("#picture_url2").val(picture_url2);
    $("#explanation").val(explanation);
    $("#type").val(type);
    $("#difficulty").val(difficulty);
    $("#author").val(author);
}
</script>





