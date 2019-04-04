@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                <div class="col-md-8">
                    <span class="dropdown mr-2">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                            全部题目 
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/online-tests/public/problems/1">全部题目</a>
                            <a class="dropdown-item" href="/online-tests/public/problems/2">已通过题目</a>
                            <a class="dropdown-item" href="/online-tests/public/problems/3">未通过题目</a>
                        </div>
                    </span>
                    <!-- | 分隔符 -->
                    <span class="border-right mr-2">
                    </span>

                    <span class="text-success mt-1 " style="font-size:19px"> 
                        默认排序
                    </span>
                    <span class="mt-1 ml-3" style="font-size:19px"> 
                        难度排序
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="col-md-4">
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="请输入题目标题">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- 题目 -->
        <div style="width:860px;float:left;">
            @foreach ($problems as $problem)
                @foreach ($problemstates as $problemstate)
                @if($problem->id == $problemstate->problem_id)
                    <!-- type=1 为判断题 -->
                    @if($problem->type == 1)
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">判断题，输入“T”代表正确或“F”代表错误</li>
                                <li class="list-group-item">第{{ $problem->chapter }}章第{{ $problem->section }}节</li>
                                <li class="list-group-item">题干: {{ $problem->stem }}</li>
                                @if($problem->picture_url1 == '')
                                @elseif($problem->picture_url2 == '')
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @else
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @endif
                            </ul>
                            <br>
                            <form method="post" action="/online-tests/public/problems">
                            {{ csrf_field() }}
                                <div class="col-md-2">
                                提交答案:
                                </div>
                                <div class="input-group col-md-6">
                                    <input type="text" class="form-control" name="answer">
                                    <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problemstate->problem_id }}">提交</button>
                                </div>
                            </form>
                            <br>
                            <div>
                            通过率：{{ $problemstate->passing_rate }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            正确提交：{{ $problemstate->correct_submit }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            总提交：{{ $problemstate->all_submit }}
                            </div>
                        </div>
                    </div>
                    <!-- type=2 为单选题 -->
                    @elseif($problem->type == 2)
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">单选题，输入下面答案中你认为正确的答案</li>
                                <li class="list-group-item">第{{ $problem->chapter }}章第{{ $problem->section }}节</li>
                                <li class="list-group-item">
                                    题干: {{ $problem->stem }}
                                    <br>
                                    {{ $problem->answer}}
                                </li>
                                @if($problem->picture_url1 == '')
                                @elseif($problem->picture_url2 == '')
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @else
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @endif
                            </ul>
                            <br>
                            <form method="post" action="/online-tests/public/problems">
                            {{ csrf_field() }}
                                <div class="col-md-2">
                                提交答案:
                                </div>
                                <div class="input-group col-md-6">
                                    <input type="text" class="form-control" name="answer">
                                    <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problemstate->problem_id }}">提交</button>
                                </div>
                            </form>
                            <br>
                            <div>
                            通过率：{{ $problemstate->passing_rate }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            正确提交：{{ $problemstate->correct_submit }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            总提交：{{ $problemstate->all_submit }}
                            </div>
                        </div>
                    </div>
                    <!-- type=3 为填空题 -->
                    @elseif($problem->type == 3)
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">填空题</li>
                                <li class="list-group-item">第{{ $problem->chapter }}章第{{ $problem->section }}节</li>
                                <li class="list-group-item">
                                    题干: {{ $problem->stem }}
                                </li>
                                @if($problem->picture_url1 == '')
                                @elseif($problem->picture_url2 == '')
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @else
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @endif
                            </ul>
                            <br>
                            <form method="post" action="/online-tests/public/problems">
                            {{ csrf_field() }}
                                <div class="col-md-2">
                                提交答案:
                                </div>
                                <div class="input-group col-md-6">
                                    <input type="text" class="form-control" name="answer">
                                    <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problemstate->problem_id }}">提交</button>
                                </div>
                            </form>
                            <br>
                            <div>
                            通过率：{{ $problemstate->passing_rate }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            正确提交：{{ $problemstate->correct_submit }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            总提交：{{ $problemstate->all_submit }}
                            </div>
                        </div>
                    </div>
                    <!-- type=4 为问答题 -->
                    @else
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">问答题</li>
                                <li class="list-group-item">第{{ $problem->chapter }}章第{{ $problem->section }}节</li>
                                <li class="list-group-item">
                                    题干: {{ $problem->stem }}
                                </li>
                                @if($problem->picture_url1 == '')
                                @elseif($problem->picture_url2 == '')
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @else
                                <li class="list-group-item">                        
                                    题目图片：
                                    <br>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                    <span>
                                        <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                                    </span>
                                </li>
                                @endif
                            </ul>
                            <br>
                            <form method="post" action="/online-tests/public/problems">
                            {{ csrf_field() }}
                                <div class="col-md-2">
                                提交答案:
                                </div>
                                <div class="input-group col-md-10">
                                    <textarea class="form-control" rows="3" type="text" name="answer"></textarea>
                                    <button type="submit" class="btn btn-success" name="problem_id" value="{{ $problemstate->problem_id }}">提交</button>
                                </div>
                            </form>
                            <br>
                            <div>
                            通过率：{{ $problemstate->passing_rate }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            正确提交：{{ $problemstate->correct_submit }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            总提交：{{ $problemstate->all_submit }}
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                @endforeach
            @endforeach
            <!-- pagination -->
            {{ $problems->links() }}
        </div>
        <!-- 筛选 -->
        <div style="hight:1000px">
            <div class="card" style="width:240px;float:right;margin-left:40px">
                <div class="card-body">
                    筛选位置
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>                    <br>
                    <br>
                    占位
                </div>
            </div>
        </div>
    <div>
</div>
@endsection




