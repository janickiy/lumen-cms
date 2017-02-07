        @if (isset($folder['state']) && $folder['state'] == 'open')
            <li>
                <a href="/{{ $container_type }}/{{ $folder['_id'] }}">
                    <i class="fa fa-folder-open"></i> <span>{{ $folder['name'] }}</span>
                </a>
            <ul>
            

            @if (isset($folder['children']))

                @foreach ($folder['children'] as $folder)
                    @include('editor::scaffold.menu.directory', $folder)
                @endforeach
                @if ($folder['folder_id'] == $selected_folder_id)
                    @foreach ($containers as $container)
                        <li><i class="fa fa-file-code-o"></i> <a href="/{{ $container_type }}/view/{{ $container['_id'] }}"><span>{{ $container['name'] }}</span></a></li>
                    @endforeach
                    
                @endif

            @else
                
                @if ($folder['_id'] == $selected_folder_id)
                    @foreach ($containers as $container)
                        <li><i class="fa fa-file-code-o"></i> <a href="/{{ $container_type }}/view/{{ $container['_id'] }}"><span>{{ $container['name'] }}</span></a></li>
                    @endforeach
                    
                @endif
            @endif

            
            </ul>
        @else
            <a href="/{{ $container_type }}/{{ $folder['_id'] }}">
                <li><i class="fa fa-folder"></i> <span>{{ $folder['name'] }}</span>
            </a>
        @endif
            </li>        