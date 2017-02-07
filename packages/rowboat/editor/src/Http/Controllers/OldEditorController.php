<?php

namespace Rowboat\Editor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Rowboat\Editor\Repositories\ComponentEditorRepositoryInterface;
use Rowboat\Editor\Models\Template\ComponentEditorContainerInterface;

abstract class EditorController extends Controller
{

    protected $repository;
    protected $container;

    public function __construct(ComponentEditorRepositoryInterface $repository, ComponentEditorContainerInterface $container){
        $this->repository = $repository;
        $this->container = $container;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_id = Input::get('parent_id');
        $this->installView($parent_id);
        return view('editor::scaffold.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $content
     * @param  int  $contianer_id
     * @param  int  $content_id
     * @return int $content_id
     */
    public function store($myContent, $container_id, $content_id='')
    {
        $content = new $this->content;
        $content->content = $myContent;
        $this->repository->addContent($content);
        // new code above
        $container = $this->container::find($container_id);
        if($content_id == ''){
            $myContent = new $this->content;
        } else {
            $myContent = $this->content::find($content_id);
        }
        $myContent->content = $content;
        $myContent->save();
        $container->contents()->save($myContent);
        return $myContent->_id; 
        return $this->repository->saveContent($content, $container_id, $content_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_id = Input::get('parent_id');
        $this->installView($parent_id);
        return view('editor::scaffold.create',['parent_id' => $parent_id]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate()
    {
        $name = Input::get('name');
        $folder_id = Input::get('folder_id');

        $container = new $this->container;
        $container->name = $name;
        $container->folder_id = $folder_id;
        $this->repository->addContainer($container); 

        return redirect($this->container_type.'/'.$folder_id.'/'.$container->_id);
    }


    ////////// move each method above this line after it's updated /////////
    
    public function installView($parent_id)
    {
        if(!isset($parent_id)){
            $parent_id = 'root';
            $parent = 'root';
        }else{
            $folder_parent = $this->repository->getFolder($parent_id);
            $parent = $folder_parent['parent_id'];
        }

        $folders = $this->repository->getFoldersByParentId($parent_id);
        $containers = $this->repository->getContainersByFolderId($parent_id);
        view()->share('folders', $folders);
        view()->share('containers', $containers);
        view()->share('parent_id', $parent_id);
        view()->share('folder_id', $parent_id);
        view()->share('parent', $parent);        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  text $parent_id
     * @return \Illuminate\Http\Response
     */
    public function createFolder()
    {
        $parent_id = Input::get('parent_id');        
        $this->installView($parent_id);
        return view('editor::scaffold.create-folder',['parent_id' => $parent_id]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  string $name
     * @param  text $parent_id
     * @return \Illuminate\Http\Response
     */
    public function postCreateFolder()
    {
        $name = Input::get('name');
        $parent_id = Input::get('parent_id');
        $component_type=Input::get('component_type');
        $folder = $this->repository->createFolder($name,$component_type,$parent_id);
        return redirect($this->container_type.'?parent_id='.$parent_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folder_id, $container_id)
    {
        $this->installView($folder_id);
        $container = $this->repository->getContainer($container_id);
        $content = $this->repository->getLatestContentByContainerId($container_id);
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
    public function edit(Request $request, $folder_id, $container_id, $content_id='')
    {
        // check for posted data
        $this->installView($folder_id);
        $content = $request->input('content');
        if($content){
            $content_id = $this->store($content, $container_id, $content_id);
        } 
        $container = $this->repository->getContainer($container_id);
        // for now, just use the latest content. This is where future updates will determine which version to edit
        if($container->contents->isEmpty()){
            $content = '';
        } else {
            $content = $container->contents->last()->content;
        }
        return view('editor::scaffold.editor', compact('container', 'content', 'content_id'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $folder_id, $container_id, $content_id)
    {
        // 
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
}
