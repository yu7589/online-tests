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
                        <span class="input-group-text">输入作业信息进行筛选</span>
                    </div>
                    <input type="text" name=classname id="classname" value="{{ $classname }}" class="form-control" placeholder="课程名">
                    <input type="text" id="chapter" value="{{ $chapter }}" name=chapter class="form-control" placeholder="第几次作业">
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
            <th style="width:60px;">学号</th>
            <th>题目</th>
            <th style="width:50px;">打分</th>
            <th style="width:60px;">评语</th>
            <th style="width:60px;">操作</th>
        </thead>
    @foreach ($problems as $problem)
        @foreach ($problemstates as $problemstate)
            @if($problem->id == $problemstate->problem_id)
            <tbody style="background-color:white">
                 <tr>
                    <td  name="Sid">{{ $problem->id }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            判断题:{{ $problem->stem }}
                        <br>
                            答案: {{ $problem->answer }}  
                    </td>
                    <td>
                        <input type="text" style="width:50px;" placeholder="0-5分">
                    </td>
                    <td>                                
                        <div class="input-group col-md-10">
                            <textarea class="form-control" rows="3" type="text" id="answer_textarea" name="answer_textarea"></textarea>
                        </div>
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <!-- edit model -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit">确定</button>
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





