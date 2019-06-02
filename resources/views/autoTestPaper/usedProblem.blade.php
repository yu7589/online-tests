@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-8">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            重点题目
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('autoTestPaper') }}">所有题目</a>
                            <a class="dropdown-item" href="{{ route('autoTestPaper.store') }}">重点题目</a>
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
                        <a href="{{ route('papersubmit') }}"><button type="button" class="btn btn-info">查看候选表单中题目</button></a>
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
                                <input id="problem_check" name="problem_check" type="checkbox" class="cb" style="width: 20px;
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
                <form method="get" action="{{ route('autoTestPaper.show') }}">
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

<form action="{{ route('autoTestPaper.store') }}" method="post" id="problem_submit">
    {{ csrf_field() }}
    <input type="hidden" value="1" name="record" id="record">
    <input type="hidden" value="" name="paper" id="paper">
</form>
@if(session('status'))
    <script>
        alert('{{session('status')}}');
    </script>
@endif
@endsection

<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>

<script>    
function show(){
    var str='';
    obj = document.getElementsByName("problem_check");
    check_val = [];
    //记录选中的chekbox,记录在check_val中
    for(k in obj){
        if(obj[k].checked)
            check_val.push(obj[k].value);
    }
    console.log(check_val);

    for(k in check_val){
        str = str + check_val[k] + '_' ;
    }
    //alert(str);
    
    $("#paper").val(str);
    var form = document.getElementById('problem_submit');
    console.log(form);
    form.submit();
    
    alert("将把已选中的题目提交到候选表单中");
}
</script>
