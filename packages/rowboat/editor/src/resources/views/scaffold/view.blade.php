@extends('editor::scaffold.base')
@section('title')
Editor
@stop
@section('content')

<div class="" style="margin-top:20px">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="/core/{{ $container['_id'] }}">{{ $container_type }} ID: {{ $container['_id'] }}</a></li>
    </ul>
</div>

<div class="row col-md-12">
    <div>
        <div class="col-xs-9"></div>
        <div class="col-xs-3">
            <a href="/{{ $container_type }}/edit/{{ $container['_id'] }}/">Edit</a>
        </div>
    </div>
</div>


<div class="row col-md-12">
    <h4>{{ $container_type }} Editor</h4>
    <h5>{{ $container_type }} Name: {{ $container['name'] }}</h5>
    <figure><pre class=" language-php"><code data-language="language-php" class=" language-php">{{ $content }}</code></pre></figure>
</div>



@stop