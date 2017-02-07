@extends('editor::scaffold.base')
@section('title')
Editor
@stop
@section('content')

<div class="" style="margin-top:20px">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">{{ $container_type }} ID: {{ $container['_id'] }}</a></li>
    <!--  <li role="presentation"><a href="#">Block ID: 123456702</a></li>
        <li role="presentation"><a href="#">Block ID: 123456703</a></li>
    -->
    </ul>
</div>

<div class="row col-md-12">
    <h4>{{ $container_type }} Editor</h4>
    <h5>{{ $container_type }} Name: {{ $container['name'] }}</h5>
    <form action="/template/edit/{{ $container['_id'] }}/{{ $content_id }}" method="post">
    {{ csrf_field() }}
    <textarea class="form-control" rows="40" id="content" name='content'>{{ $content }}</textarea>
</div>



<div class="row col-md-12">
    <div>
        <div class="col-xs-9"></div>
        <div class="col-xs-3">
            <form action="/template/edit/{{ $container['_id'] }}" method="post">
            <button class="btn btn btn-primary">Save</button>
        </form>
        </div>
    </div>
</div>

@stop