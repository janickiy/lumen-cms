@extends('editor::scaffold.base')
@section('title')
Create
@stop
@section('content')
<div class="container">
    <h3>Add New Folder {{ ucfirst($container_type) }}</h3>
    <div>
        <form action="/{{ $container_type }}/createFolder" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <input name="parent_id" value="{{ $parent_id }}" type="hidden"/>
                <label>{{ ucfirst($container_type) }} folder name &nbsp;&nbsp;</label>
                <input type="text" name="name"></input>
            </div>
            @if($parent_id=='root')
                <div class="form-group">
                    <label>Component type &nbsp;&nbsp;</label>

                    <select name="component_type">
                        <option value="template_type" selected>Templates type</option>
                        <option value="page_type">Pages type</option>
                        <option value="block_type">Blocks type</option>
                        <option value="asset_type">Assets type</option>
                    </select>
                </div>
            @endif
            <button class="btn btn btn-primary">Create folder</button>
        </form>
    </div>
</div>
@stop