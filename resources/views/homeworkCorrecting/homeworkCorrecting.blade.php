@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 题目 -->
    <form method="get" action="{{ route('homeworkCorrecting') }}">
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
            @if($problem->id == $problemComplete->problem_id && $problemComplete->rightness = 100)
            <tbody style="background-color:white">
                 <tr>
                    @if($problemComplete->type == 3)
                    <td  name="Sid">{{ $problemComplete->student_number }}</td>
                    <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            填空题:{{ $problem->stem }}
                            <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br>
                        <br>
                            学生答案: {{ $problemComplete->answer_save }}  
                        <br>
                        <br>
                            标准答案: {{ $problem->answer }}  
                            <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                    </td>
                    @else
                    <td  name="Sid">{{ $problemComplete->student_number }}</td>
                        <td  name="Sname">                   
                            {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                            <br>
                            简答题:{{ $problem->stem }}
                            <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                        <br><br>
                            学生答案: {{ $problemComplete->answer_save }}  
                        <br>
                        <br>
                            标准答案: {{ $problem->answer }}  
                            <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                    </td>
                    @endif
                    <td>
                        <input type="text" style="width:50px;" id="score" name="score" placeholder="0-5分" oninput="getScore(this.value)">
                    </td>
                    <td>                                
                        <div class="input-group col-md-10">
                            <textarea class="form-control" style="width:180px;" rows="3" type="text" id="comment" name="comment" oninput="getComment(this.value)"></textarea>
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
    <form action="{{ route('homeworkCorrecting.store') }}" method="post" id="submit">
        {{ csrf_field() }}
        <input type="hidden" value="" name="answer" id="answer">
    </form>
</div>
@endsection

<script>
var answers = new Array();
answers[0] = 0;
answers[1] = 0;
answers[2] = 0;
answers[3] = 0;
function getScore(val){
    answers[0] = val;
}
function getComment(val){
    answers[1] = val;
}
function formsubmit(number, id){
    answers[2] = number;
    answers[3] = id;
    var str = answers[0] + '_' + answers[1] + '_' + answers[2] + '_' + answers[3];
    //alert(str);
    $('#answer').val(str);
    var form = document.getElementById('submit');
    form.submit();
}

</script>





