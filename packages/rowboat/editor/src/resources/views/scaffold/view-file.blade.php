@extends('editor::scaffold.base') 

@section('title') 
View File 
@stop 

@section('content')
<div>
    <h3>View File</h3>
   

    <div class="row col-md-12">
        <div class="col-xs-4">Asset Name: custom.css</div>
        <div class="col-xs-4">Assets ID:12345602</div>
        <div class="col-xs-4 text-right">Status: Draft</div>
    </div>



    <div class="col-xs-12">




        <figure><pre class=" language-php"><code data-language="language-php" class=" language-php">
.col-xs-5,
.col-sm-5,
.col-md-5,
.col-lg-5 {
    position: relative;
    min-height: 1px;
    padding-right: 10px;
    padding-left: 10px;
}

.col-xs-5ths {
    width: 20%;
    float: left;
}

@media (min-width: 768px) {
    .col-sm-5ths {
        width: 20%;
        float: left;
    }
}

</code></pre></figure>
    </div>
</div>
<div class="row col-md-12">
    <div class="col-xs-9">
    </div>
    <div class="col-xs-3">
        <button class="btn btn-primary">Save</button>
        <button class="btn btn-primary">Publish</button>
    </div>
</div>
@stop