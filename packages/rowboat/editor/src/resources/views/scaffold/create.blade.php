@extends('editor::scaffold.base')
@section('title')
Create
@stop
@section('content')
<div class="container">
    <h3>Add New {{ ucfirst($container_type) }}</h3>
    <div>
        <form action="/{{ $container_type }}/create/{{ $selected_folder_id }}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label>{{ ucfirst($container_type) }} file name &nbsp;&nbsp;</label>
                <input type="text" name="name"></input>
            </div>

            <div class="form-group">

                <label>Component type &nbsp;&nbsp;</label>
                <select name="component_type">
                    <option value="template" selected>Templates type</option>
                    <option value="page">Pages type</option>
                    <option value="block">Blocks type</option>
                    <option value="asset">Assets type</option>
                </select>
            </div>     
            

            <button class="btn btn btn-primary">Create file</button>
        </form>
    </div>
</div>
@stop