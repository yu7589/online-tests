@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-12 m-1">
        <div class="card-body row">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                    全部题目 
                </button>
                &nbsp; 
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">全部题目</a>
                    <a class="dropdown-item" href="#">已通过题目</a>
                    <a class="dropdown-item" href="#">未通过题目</a>
                </div>
            </div>
            
            <!-- | 分隔符 -->
            <div class="border-right">
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <!-- 题目 -->
        <div class="card col-md-8 m-1">
            <div class="card-body row">
                题目
            </div>
        </div>

        <!-- 筛选 -->

        <div class="card col-md-3 m-1">
            <div class="card-body row">
                筛选
            </div>
        </div>
    <div>

</div>
@endsection




