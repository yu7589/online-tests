@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                    <span class="dropdown">
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
                    <div class="border-right mr-2">
                    </div>

                    <span class="text-success mt-1 " style="font-size:19px"> 
                        默认排序
                    </span>
                    <span class="mt-1 ml-3" style="font-size:19px"> 
                        难度排序
                        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                    </span>


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
                题目位置
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




