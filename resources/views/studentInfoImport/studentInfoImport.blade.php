@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">选择一种方式将导入学生信息</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form class="form-horizontal" method="POST" action="/online-tests/public/studentInfoImport/upload" enctype="multipart/form-data">
                                {{ csrf_field() }}           
                                <label for="file">从.csv格式文件导入学生信息</label>
                                <div class="col-sm-10">
                                    <input id="file" type="file" class="form-control" name="source" required>    
                                </div>
                                <br>
                                <div class="form-group" style="float:right;margin-right:185px">
                                    <button type="submit" class="btn btn-primary">
                                        确定
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="list-group-item">
                            <label class="text-center">添加学生信息</label>
                            <form class="form-horizontal" method="post" action="/online-tests/public/studentInfoImport/creating" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">学号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="student_number" placeholder="请输入学生学号名" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="请输入学生姓名" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-2 control-label">班级</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="class" placeholder="请输入学生班级" required="required">
                                    </div>
                                </div>
                                <div class="form-group" style="float:right;margin-right:185px">
                                    <button type="submit" class="btn btn-primary">
                                        确定
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
@if(session('status'))
        <script>
            alert('{{session('status')}}');
        </script>
@endif
@endsection
