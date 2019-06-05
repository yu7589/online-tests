@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-8">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            已通过题目
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
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 题目 -->
        <div style="width:860px;float:left;">
            <table id="Tab" class="table table-bordered table-hover">
                <thead>
                    <th style="width:60px;">序号</th>
                    <th>题目</th>
                    <th style="width:120px;"></th>
                </thead>
            @foreach($problemcomplete as $complete)
                @foreach ($problems as $problem)
                    @if($complete->problem_id == $problem->id)
                        @foreach ($problemstates as $problemstate)
                            @if($problem->id == $problemstate->problem_id)
                            <tbody style="background-color:#fff;">
                                 <tr>
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
                                        提交答案: {{ $complete->answer_save }}
                                        <br>
                                        正确答案: {{ $problem->answer}}
                                        <br>
                                        <br>
                                        解释：{{ $problem->explanation }}
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
                                            选项:
                                            &nbsp;A.{{ explode(";", str_replace('*', '', $problem->answer), 4)[0] }}
                                            &nbsp;B.{{ explode(";", str_replace('*', '', $problem->answer), 4)[1] }}
                                            &nbsp;C.{{ explode(";", str_replace('*', '', $problem->answer), 4)[2] }}
                                            &nbsp;D.{{ explode(";", str_replace('*', '', $problem->answer), 4)[3] }}
                                            <br>
                                            提交答案：&nbsp;{{ $complete->answer_save }}
                                            <br>
                                            正确答案：
                                            <?php 
                                                $answers = explode(";", $problem->answer, 4);
                                                $letter = '';
                                                //dd(substr_count($answers[2], '**'));
                                                for($i=0; $i<4; $i++){
                                                    if(substr_count($answers[$i], '**') == 2){
                                                        switch($i){
                                                            case 0:
                                                                $letter = 'A';
                                                                break;
                                                            case 1:
                                                                $letter = 'B';
                                                                break;
                                                            case 2:
                                                                $letter = 'C';
                                                                break;
                                                            case 3:
                                                                $letter = 'D';
                                                                break;
                                                        }
                                                    }
                                                }
                                                echo $letter;
                                            ?>
                                            <br><br>
                                            解释：{{ $problem->explanation }}
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
                                            提交答案：&nbsp;{{ $complete->answer_save }}
                                            <br>
                                            正确答案：{{ $problem->answer }}
                                        @if($problem->picture_url2 != null)
                                        <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                                        @endif
                                        @if($complete->comment != 0)
                                            <br><br>
                                            评语：{{ $complete->comment }}
                                        @endif
                                        <br><br>
                                        解释：{{ $problem->explanation }}
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
                                            提交答案：&nbsp;{{ $complete->answer_save }}
                                        <br>
                                            正确答案：{{ $problem->answer }}
                                        @if($problem->picture_url2 != null)
                                        <?php echo EndaEditor::MarkDecode($problem->picture_url2) ?>
                                        @endif
                                        @if($complete->comment != 0)
                                            <br><br>
                                            评语：{{ $complete->comment }}
                                        @endif
                                        <br><br>
                                        解释：{{ $problem->explanation }}
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
                    @endif
                @endforeach
            @endforeach
            </table>
            <!-- pagination -->
            {!! $problemcomplete->appends(['chapter'=>$chapter, 'section'=>$section, 'classname'=>$classname, 'pageNumber'=>$pageNumber])->links() !!}
        </div>

        <!-- 筛选 -->
        <div style="hight:1000px">
            <div class="card" style="width:240px;float:right;margin-left:40px;margin-top:45px;">
                <div class="card-body">
                <form method="get" action="{{ route('problems.show') }}">
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
                    </div>
                    </form>
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

