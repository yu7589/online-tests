@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-5">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            未通过题目
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('problems') }}">未通过题目</a>
                            <a class="dropdown-item" href="{{ route('problems.show') }}">已通过题目</a>
                        </div>
                    </span>
                    <!-- | 分隔符 -->
                    <span class="border-right mr-2">
                    </span>

                    <span class="text-success mt-1 " style="font-size:19px"> 
                        默认排序
                    </span>
                </div>
                
                <div class="col-md-3">
                    <div class="input-group ">
                        <a href="{{ route('problems.showHomework') }}"><button type="button" class="btn btn-info">查看布置的作业</button></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group ">
                        <a href="{{ route('submit') }}"><button type="button" class="btn btn-info">查看提交表单中题目</button></a>
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
                <!--暂时把全选的功能取消掉
                                                      
                            <input id="selectAll" type="checkbox" class="cb" onclick="selectAll()" style="width: 20px;
                                height: 20px;
                                border: 1px solid #c9c9c9;
                                border-radius: 2px;
                                ">
                        
                -->
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
                                <form method="post" action="{{ route('problems.store') }}">
                                {{ csrf_field() }}
                                    答案:
                                    <div class="row">
                                        <div style="padding-left:20px; padding-top:5px">
                                            <input type="radio" name="radio1" id="true" onclick="record({{ $problem->id }}, 'T')">
                                            <label style="padding-left:8px">
                                                T
                                            </label>
                                        </div>
                                        <div style="padding-left:15px; padding-top:5px" onclick="record({{ $problem->id }}, 'F')">
                                            <input type="radio" name="radio1" id="false">
                                            <label style="padding-left:8px">
                                                F
                                            </label>
                                        </div>
                                    </div>
                                </form>
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
                                <form method="post" action="{{ route('problems.store') }}">
                                {{ csrf_field() }}
                                    答案:
                                    <input name="selectradio" type="radio" class="cb" onclick="record({{ $problem->id }}, 'A')">
                                    &nbsp;A.{{ explode(";", str_replace('*', '', $problem->answer), 4)[0] }}
                                    <input name="selectradio" type="radio" class="cb" onclick="record({{ $problem->id }}, 'B')">
                                    &nbsp;B.{{ explode(";", str_replace('*', '', $problem->answer), 4)[1] }}
                                    <input name="selectradio" type="radio" class="cb" onclick="record({{ $problem->id }}, 'C')">
                                    &nbsp;C.{{ explode(";", str_replace('*', '', $problem->answer), 4)[2] }}
                                    <input name="selectradio" type="radio" class="cb" onclick="record({{ $problem->id }}, 'D')">
                                    &nbsp;D.{{ explode(";", str_replace('*', '', $problem->answer), 4)[3] }}
                                </form>
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
                                <form method="post" action="{{ route('problems.store') }}">
                                {{ csrf_field() }}
                                    答案:
                                    <div class="input-group" style="width:280px;">
                                        <input type="text" class="form-control" id="answer_text" value=" " placeholder="答案请用分号分隔，例：xx;xx;" name="answer_text"  oninput="record({{ $problem->id }}, this.value)">
                                    </div>
                                </form>
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
                                <form method="post" action="{{ route('problems.store') }}">
                                {{ csrf_field() }}
                                答案:                  
                                <div class="input-group col-md-10">
                                    <textarea class="form-control" rows="3" type="text" id="answer_textarea" name="answer_textarea" oninput="record({{ $problem->id }}, this.value)"></textarea>
                                </div>
                                </form>
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
                <form method="get" action="{{ route('problems') }}">
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
                    <button type="submit" class="btn btn-info" onclick="show()">提交已作答题目</button>
                </div>
            </div>
        </div>
    <div>
</div>

<form action="{{ route('problems.store') }}" method="post" id="answer_submit">
    {{ csrf_field() }}
    <input type="hidden" value="" name="answer" id="answer">
</form>
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

/*
记录选中的问题
*/
function record(id, str){

    var i=1;
    for(; i<=50; i++){
        if(answered[0][i] == id){
            answered[1][i] = str;
            break;
        }
        else if(answered[0][i] == 999999){
            answered[0][i] = id;
            answered[1][i] = str;
            break;
        }else {
            continue;
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
    //alert(str);
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
    alert("将把已勾选已作答的题目提交到已选中题目表单中");
}

function test(val){
    alert(val);
}
</script>
