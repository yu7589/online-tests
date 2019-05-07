@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                
            
                <div class="col-md-4">
                    <div class="input-group ">
                        <button type="button" class="btn btn-success">已选中题目</button>
                    </div>
                    {{ $str }}
                    "<h1>a</h1>"
                    <?php echo " $str " ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection