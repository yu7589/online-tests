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
                            <form class="form-horizontal" method="POST" action="/online-tests/public/problemImport/upload" enctype="multipart/form-data">
                                {{ csrf_field() }}           
                                <label for="file">从.md格式文件导入题库</label>
                                <div class="col-sm-10">
                                    <input id="file" type="file" class="form-control" name="source" required>    
                                </div>
                                <br>
                                <div class="form-group" style="float:right;margin-right:185px">
                                    <button type="submit" class="btn btn-primary">
                                        上传
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <label class="text-center">添加试题</label>
                            <form class="form-horizontal" method="post" action="/online-tests/public/problemImport" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">题干</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="QU" placeholder="请输入题干" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">答案</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="SO" placeholder="请输入答案" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">题目图片</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lastname" placeholder="请输入题目图片" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">答案图片</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="SF" placeholder="请输入答案图片" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">解答</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="AN" placeholder="请输入解答" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-2 control-label">题目编号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="CO" placeholder="请输入题目编号" required="required">
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
