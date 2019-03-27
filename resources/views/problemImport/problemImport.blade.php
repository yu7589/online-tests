@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">选择一种方式将题目导入题库</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <button type="button" class="btn btn-primary">
                                从.md格式文件导入题库
                            </button>
                        </li>
                        <li class="list-group-item">
                            <label class="text-center">添加试题</label>
                            <form class="form-horizontal" method="post" action="/online-tests/public/problemImport" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">QU</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="QU" placeholder="请输入QU">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">SO</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="SO" placeholder="请输入SO">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">QF</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lastname" placeholder="请输入QF">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">SF</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="SF" placeholder="请输入SF">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">AN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="AN" placeholder="请输入AN">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">CO</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="CO" placeholder="请输入CO">
                                    </div>
                                </div>
                                <div class="form-group" style="float:right;margin-right:185px">
                                    <button type="submit" class="btn btn-primary">
                                        提交
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
