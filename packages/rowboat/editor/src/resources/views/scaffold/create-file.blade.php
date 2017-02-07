@extends('editor::scaffold.base') 
@section('title') Create Files 
@stop 
@section('content')
<div class="container">
    <h3>Add New Assets</h3>
    <div>
        <form>
            <div class="form-group">
                <label>Folder &nbsp;&nbsp;</label>
                <input></input>
                <br>
                <label>Name &nbsp;&nbsp;</label>
                <input></input>
                <div class="dropdown">
                    <label>Type&nbsp;&nbsp;</label>
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Choose...
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">Javascript</a></li>
                        <li><a href="#">Image</a></li>
                        <li><a href="#">Download</a></li>
                    </ul>
                </div>

                <label>Upload &nbsp;&nbsp;</label>
                <input></input>
                <label class="btn btn-default" for="my-file-selector">
                    <input id="my-file-selector" type="file" style="display:none;"> Browse
                </label>

            </div>
        </form>
    </div>

</div>
<div class="row col-md-12">
    <div>
        <div class="col-xs-6">

        </div>
        <div class="col-xs-6">
            <button class="btn btn-primary">Create</button>

        </div>
    </div>
</div>
@stop