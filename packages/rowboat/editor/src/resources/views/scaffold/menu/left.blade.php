<div class="container" >
    <h3>{{ ucfirst($container_type) }}</h3>
    <ul>
    @foreach ($folders as $folder)
        @include('editor::scaffold.menu.directory', $folder)
    @endforeach
    </ul>
    <ul>
        <li>
            <form action="/{{ $container_type }}/create/{{$selected_folder_id}}">
            <button class="btn btn btn-primary">Add</button>
            </form>
        </li>
    </ul>
</div>


<div class="container" style="margin-top:100px">

    <ul>
        <li><i class="fa fa-folder"></i> <span>Assets</span></li>
        <li><i class="fa fa-folder"></i> <span>Block</span></li>
        <li><i class="fa fa-folder"></i> <span>Pages</span></li>
        <li><i class="fa fa-folder"></i> <span>Template</span></li>
    </ul>

</div>