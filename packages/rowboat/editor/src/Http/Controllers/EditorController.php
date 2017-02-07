<?php

namespace Rowboat\Editor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Rowboat\Editor\Repositories\ComponentEditorRepositoryInterface;
use Rowboat\Editor\Repositories\FolderEditorRepository;
use Rowboat\Editor\Models\Component\ComponentEditorContainerInterface;



abstract class EditorController extends Controller
{

    protected $repository;
    protected $container;

    protected $folder;

    public function __construct(ComponentEditorRepositoryInterface $repository, FolderEditorRepository $folder, ComponentEditorContainerInterface $container){
        $this->repository = $repository;
        $this->container = $container;

        $this->folder = $folder;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folder_id = 'root')
    {
        $this->prepareLeftMenu($folder_id);
        return view('editor::scaffold.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($folder_id = 'root')
    {
         $this->prepareLeftMenu($folder_id);
        return view('editor::scaffold.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  string $name
     * @param  int  $folder_id
     * @return int $container_id
     */
    public function store($folder_id = 'root',Request $request)
    {
        $name = $request->input('name');
        $component_type = $request->input('component_type');
        $container = new $this->container;
        $container->name = $name;
        $container->folder_id = $folder_id;
        $container->component_type = $component_type;
        $this->repository->addContainer($container);
        
        return redirect($this->container_type.'/view/'.$container->_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($container_id, $content_id='')
    {
        // todo, use $content_id if explicitly set
        $container = $this->repository->getContainer($container_id);
        $selected_folder_id = $container['folder_id'];
        if($content_id != ''){
            $content = $this->repository->getContentById($content_id);
            if($content['container_id'] != $container_id){
                // todo, throw exception
                echo "an error has occured";
                die;
            }
            // make sure container_id's match from container and content
            $content = $content['content'];
        } else {
            $content = $this->repository->getLatestContentByContainerId($container_id);
        }
        $this->prepareLeftMenu($selected_folder_id);
        //return response()->json($container, 200, array(), JSON_PRETTY_PRINT);
        return view('editor::scaffold.view', compact('container', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $contianer_id
     * @param  int  $content_id
     * @return \Illuminate\Http\Response
     */
    public function edit($container_id, $content_id='')
    {
        $container = $this->repository->getContainer($container_id);
        $selected_folder_id = $container['folder_id'];
        if($content_id != ''){
            $content = $this->repository->getContentById($content_id);
            if($content['container_id'] != $container_id){
                // todo, throw exception
                echo "an error has occured";
                die;
            }
            // make sure container_id's match from container and content
            $content = $content['content'];
        } else {
            $content = $this->repository->getLatestContentByContainerId($container_id);
        }
        $this->prepareLeftMenu($selected_folder_id);
        return view('editor::scaffold.editor', compact('container', 'content', 'content_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $container_id, $content_id='')
    {
        $postedContent = $request->input('content');
        if($postedContent){
            $this->repository->addContent($postedContent, $container_id, $content_id);
        }
        return $this->show($container_id, $content_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function prepareLeftMenu($folder_id = 'root')
    {
        $containers = $this->repository->getContainersByFolderId($folder_id);
        $folders = $this->folder->getAllNestedFoldersByComponentTrackOpenFolders($this->container_type, 'root', $folder_id);
        // dd( $containers);
        view()->share('folders', $folders);
        view()->share('containers', $containers);
        view()->share('selected_folder_id', $folder_id);

    }
    
}
