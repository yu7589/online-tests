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
                            <a class="dropdown-item" href="#">全部题目</a>
                            <a class="dropdown-item" href="#">已通过题目</a>
                            <a class="dropdown-item" href="#">未通过题目</a>
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
                <div class="card mb-3">
                    <div class="card-body">
                        计数：：：：：{{ $problemstate->id }}
                        <h5>第{{ $problem->chapter }}章第{{ $problem->section }}节</h5>
                        <h5>题干: {{ $problem->stem }}</h5> 
                        <h5>题目图片：</h5>
                        <span>
                            <img class="img-fluid"  src="../{{ $problem->picture_url1 }}">
                        </span>
                        <br>
                        <br>
                        <h5>提交答案:</h5>
                        <form>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control">
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




