@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-8">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            所有题目
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/online-tests/public/autoTestPaper">所有题目</a>
                            <a class="dropdown-item" href="/online-tests/public/autoTestPaper/used">重点题目</a>
                        </div>
                    </span>
                    <!-- | 分隔符 -->
                    <span class="border-right mr-2">
                    </span>

                    <span class="text-success mt-1 " style="font-size:19px"> 
                        默认排序
                    </span>
                </div>

                <div class="col-md-4">
                    <div class="input-group ">
                        <a href="http://localhost/online-tests/public/autoTestPaper/submit"><button type="button" class="btn btn-info">查看候选表单中题目</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 题目 -->
        <div style="width:860px;float:left;">
            <table id="Tab" class="table table-bordered table-hover">
                <thead>  
                    <th></th>
                    <th style="width:60px;">序号</th>
                    <th>题目</th>
                    <th style="width:120px;"></th>
                </thead>
            @foreach ($problems as $problem)
                @foreach ($problemstates as $problemstate)
                    @if($problem->id == $problemstate->problem_id)
                    <tbody style="background-color:#fff;">
                         <tr>
                            <td>
                                <input id="answer_check" name="answer_check" type="checkbox" class="cb" style="width: 20px;
                                height: 20px;
                                border: 1px solid #c9c9c9;
                                border-radius: 2px;"
                                value='{{$problem->id}}'>
                            </td>
                            <!-- type=1 为判断题 -->
                            @if($problem->type==1)
                            <td>{{ $problem->id }}</td>
                            <td>                   
                                {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                                <br>
                                判断题:{{ $problem->stem }}
                                <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                                <br>
                                <br>
                                    答案:
                                        {{ $problem->answer }}
                                <br>
                                <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                            </td>
                            <!-- 类型2为选择题 -->
                            @elseif($problem->type==2)
                            <td>{{ $problem->id }}</td>
                            <td>                   
                                {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                                <br>
                                选择题:{{ $problem->stem }}
                                <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                                <br>
                                <br>
                                    答案:
                                <?php echo EndaEditor::MarkDecode($problem->answer) ?>  
                                <br>     
                                <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                            </td>
                            <!-- 类型3为填空题 -->
                            @elseif($problem->type==3)
                            <td>{{ $problem->id }}</td>
                            <td>                   
                                {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                                <br>
                                填空题:{{ $problem->stem }}
                                <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                                <br>
                                <br>
                                    答案:
                                <?php echo EndaEditor::MarkDecode($problem->answer) ?>
                                <br>
                                <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                            </td>
                            <!-- 类型4 为简答题 -->
                            @else
                            <td>{{ $problem->id }}</td>
                            <td>                   
                                {{ $problem->classname }}：第{{ $problem->chapter }}章第{{ $problem->section }}节
                                <br>
                                简答题:{{ $problem->stem }}
                                <?php echo EndaEditor::MarkDecode($problem->picture_url1) ?>
                                <br>
                                <br>
                                答案:                  
                                <?php echo EndaEditor::MarkDecode($problem->answer) ?>
                                <br>
                                <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                            </td>
                            @endif
                            <td>
                                通过率：{{ $problemstate->passing_rate }} 
                                <br>
                                正确提交：{{ $problemstate->correct_submit }} 
                                <br>
                                总提交：{{ $problemstate->all_submit }}
                            </td>
                         </tr>
                    </tbody>
                    @endif
                @endforeach
            @endforeach
            </table>
            <!-- pagination -->
            {!! $problems->appends(['chapter'=>$chapter, 'section'=>$section, 'classname'=>$classname, 'pageNumber'=>$pageNumber])->links() !!}
        </div>

        <!-- 筛选 -->
        <div style="hight:1000px">
            <div class="card" style="width:240px;float:right;margin-left:40px;margin-top:45px;">
                <div class="card-body">
                <form method="get" action="/online-tests/public/autoTestPaper">
                    <div>
                        <label>每页显示
                            <input size="2" type="text" id="pageNumber" name="pageNumber" value="{{ $pageNumber }}" aria-controls="data-table"> 题目
                        </label>
                        <br>
                        <br>
                        输入课程信息进行筛选
                            <input type="text" name=classname id="classname" value="{{ $classname }}" class="form-control" placeholder="课程名">
                        <br>
                        <div class="input-group mb-3">
                            <input type="text" name=chapter id="chapter" value="{{ $chapter }}" class="form-control" placeholder="章">
                            <input type="text" name=section id="section" value="{{ $section }}" class="form-control" placeholder="节">
                            &nbsp;
                            <button type="submit" class="btn btn-success">
                            确定
                            </button>  
                        </div>
                        <br>
                    </div>
                    </form>
                    <button type="submit" class="btn btn-info" onclick="show()">将选中题目提交到候选表单</button>
                </div>
            </div>
        </div>
    <div>
</div>

@if(session('status'))
    <script>
        alert('{{session('status')}}');
    </script>
@endif
@endsection

<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>

<script>    
var answered = new Array(2);
answered[0] = new Array();
answered[0][0] = 'id';
for(var i=1; i<=50; i++){
    answered[0][i] = 999999;
}
answered[1] = new Array();
answered[1][0] = 'stem';
for(var i=1; i<=50; i++){
    answered[1][i] = 'null';
}
var count = 1;
/*
记录选中的问题
*/
function record(id, str){
    var i=1
    for(; i<=50; i++){
        if(answered[0][i] == id){
            answered[1][i] = str;
            break;
        }
        else{
            answered[0][count] = id;
            answered[1][count] = str;
            count++;
            break;
        }
    }
    
    console.log(answered);
}

function show(){
    var str='';
    obj = document.getElementsByName("answer_check");
    check_val = [];
    //记录选中的chekbox
    for(k in obj){
        if(obj[k].checked)
            check_val.push(obj[k].value);
    }
    //交叉查询checkbox和之前记录的答案数组，如果id相同，则需要提交，将其id和答案一起记录在字符串中
    for(k in check_val){
        for(let i=1; i<=50; i++){
            if(check_val[k] == answered[0][i]){
                str = str + answered[0][i] + '_' + answered[1][i] + '_';
            }
            else{
                continue;
            }
        }
    }
    $("#answer").val(str);
    var form = document.getElementById('answer_submit');
    console.log(form);
    form.submit();
    /*
    $.post('http://localhost/online-tests/public/submit/answer',{'_token':'{{csrf_token()}}','answer': str},function(data){
        //验证成功后实现跳转
        console.log(str);
        window.location.href = 'http://localhost/online-tests/public/submit';
    }),
    */
    alert("将把已作答的题目提交到已选中题目表单中");
}
</script>
