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
                            标准答案: {{ $problem->answer }}  
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
                        <input type="text" style="width:50px;" id="score" name="score" placeholder="0-5分" onmouseout="getScore(this.value)">
                    </td>
                    <td>                                
                        <div class="input-group col-md-10">
                            <textarea class="form-control" style="width:140px;" rows="3" type="text" id="comment" name="comment" onmouseout="getComment(this.value)"></textarea>
                        </div>
                    </td>
                    <td>
                        <input type="hidden" id="student_number" name="student_number" value="{{ $problemComplete->student_number }}">
                        <input type="hidden" id="problem_id" name="problem_id" value="{{ $problem->id }}">
                        <button type="button" style="width:60px;" class="btn btn-success" onclick="formsubmit({{ $problemComplete->student_number }}, {{ $problem->id }})">确定</button>
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
    <form action="/online-tests/public/homeworkCorrecting/store" method="post" id="submit">
    {{ csrf_field() }}
    <input type="hidden" value="" name="answer_score" id="answer_score">
    <input type="hidden" value="" name="answer_comment" id="answer_comment">
    <input type="hidden" value="" id="answer_number" name="answer_number">
    <input type="hidden" value="" id="answer_id" name="answer_id">
    </form>
</div>
@endsection

<script>
function getScore(val){
    $("#answer_score").val(val);
}
function getComment(val){
    $("#answer_comment").val(val);
}
function formsubmit(number, id){
    $("#answer_number").val(number);
    $("#answer_id").val(id);
    alert(number);
    var form = document.getElementById('submit');
    form.submit();
}

</script>





