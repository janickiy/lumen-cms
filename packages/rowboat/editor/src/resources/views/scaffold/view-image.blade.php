@extends('editor::scaffold.base') 

@section('title') 
View Image
@stop 

@section('content')



<div class="row col-md-12">
    <h3>View Image</h3>
    <div class="col-xs-4">Image Name: logo.png</div>
    <div class="col-xs-4">Assets ID:12345601</div>
    <div class="col-xs-4 text-right">Status: Draft</div>
</div>

<div class="row col-md-12">
    <div class="col-xs-12"><img src="http://placekitten.com/670/250" /></div>
    <div class="col-xs-12"><p>Image Name: cat.jpg<br>File Size: 20kb<br></p></div>
</div>


<div class="row col-md-12">
    <div class="col-xs-8">
    </div>
    <div class="col-xs-3">
        <button class="btn btn-primary">Save</button>
        <button class="btn btn-primary">Publish</button>
    </div>
</div>
@stop