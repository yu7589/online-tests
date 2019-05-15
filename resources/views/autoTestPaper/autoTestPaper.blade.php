@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-body row">
                一、判断题<br>
                    @foreach($counts as $count)
                    {{ $count + 1 }}.{{ $problems[$count]->stem }}<br>
                    @endforeach
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
                    <br>
                    <br>
                二、选择题
            </div>
        </div>
    </div>



</div>
@endsection