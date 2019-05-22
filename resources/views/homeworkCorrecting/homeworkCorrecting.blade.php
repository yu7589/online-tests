@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="get" action="/online-tests/public/homeworkCorrecting">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">输入课程名进行筛选</span>
                    </div>
                    <input type="text" name=classname id="classname" value="{{ $classname }}" class="form-control" placeholder="课程名">
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
            <th style="width:40px;">学号</th>
            <th>题目</th>
            <th style="width:50px;">打分</th>
            <th style="width:60px;">评语</th>
            <th style="width:60px;">操作</th>
        </thead>
    @foreach ($problemCompletes as $problemComplete)
        @foreach($problems as $problem)
            @if($problem->id == $problemComplete->problem_id)
            <tbody style="background-color:white">
                 <tr>
                    @if($problemComplete->type == 3)
                    <td  name="Sid">{{ $problemComplete->student_number }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            填空题:{{ $problem->stem }}
                        <br>
                        <br>
                            学生答案: {{ $problemComplete->answer_save }}  
                        <br>
                        <br>
                            标准答案: aaaaa {{ $problem->answer }}  
                    </td>
                    @else
                    <td  name="Sid">{{ $problemComplete->student_number }}</td>
                        <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            简答题:{{ $problem->stem }}
                        <br><br>
                            学生答案: {{ $problemComplete->answer_save }}  
                        <br>
                        <br>
                            标准答案: {{ $problem->answer }}  
                    </td>
                    @endif

                    <td>
                        <input type="text" style="width:50px;" placeholder="0-5分">
                    </td>
                    <td>                                
                        <div class="input-group col-md-10">
                            <textarea class="form-control" style="width:140px;" rows="3" type="text" id="answer_textarea" name="answer_textarea"></textarea>
                        </div>
                    </td>
                    <td>
                        <div class="container">
                            <div class="row">
                                <!-- edit model -->
                                <button type="button" style="width:60px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit">确定</button>
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
    {!! $problemCompletes->appends(['classname'=>$classname])->links() !!}
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





