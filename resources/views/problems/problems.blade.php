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
        <div class="card col-md-8">
            <div class="card-body">
                <span>（第一章第一节，章节）</span><span>（题干）</span> 
                <br>
                <span>题目图片</span>
                <br>
                <span>提交答案
                @foreach ($problems as $problem)
                    {{ $problem->stem }}
                    <br>
                @endforeach
                </span>
                <br>
            </div>
        </div>
        <!-- 筛选 -->
        <div class="card col-md-3" style="margin-left:95px">
            <div class="card-body">
                筛选位置
            </div>
        </div>
    <div>
</div>
@endsection




