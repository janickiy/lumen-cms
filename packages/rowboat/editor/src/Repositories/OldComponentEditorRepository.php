<?php

namespace Rowboat\Editor\Repositories;

use Rowboat\Editor\Entities\ComponentEditorFolderInterface;
use Rowboat\Editor\Entities\ComponentEditorContainerInterface;
use Rowboat\Editor\Entities\ComponentEditorContentInterface;

abstract class ComponentEditorRepository extends \Rowboat\Core\Repositories\ComponentRepository implements ComponentEditorRepositoryInterface 
{
	protected $folder;

	public function __construct(ComponentEditorFolderInterface $folder,
						ComponentEditorContainerInterface $container,
						ComponentEditorContentInterface $content)
	{
		$this->folder = $folder;
		parent::__construct($container, $content);
    }

	public function addContainer(ComponentEditorContainerInterface $container)
	{
		$container->save();	
	}
/////////////////// old stuff, that should be refactored, and placed above
	public function getAll(){
		return($this->container::all());
	}

	public function getContainer($container_id){
		return($this->container::find($container_id));
	}

	public function getContainersByFolderId($folder_id){
		return $this->container::where('folder_id',$folder_id)->get();
	}

	public function xx_getLatestContentByContainerId($container_id){
		$contents = $this->content::where('container_id',$container_id)->get();
		//$content = array_slice($contents, -1, 1, TRUE);
		if($contents->count()){
			return($contents->last()->content);
		} else {
			return('');
		}
	}

//	public function getContent($content_id=''){
//		$content = $this->content::find($content_id);
//		return($content->content);
//	}
	public function createContainer($name,$component_type, $folder_id = ''){
        $this->container->name = $name;
		if($folder_id && $folder_id!='root')
		{
			$folder=$this->getFolder($folder_id);
			$this->container->component_type = $folder->component_type;
		}
		else{
			$this->container->component_type = $component_type;
		}

		$this->container->folder_id = $folder_id;
        $this->container->save();
		return($this->container);
	}

	public function createFolder($name,$component_type, $parent_id = ''){
        $this->folder->name = $name;		
		$this->folder->parent_id = $parent_id;
		
		if($parent_id && $parent_id!='root')
		{
			$folder=$this->getFolder($parent_id);
			$this->folder->component_type = $folder->component_type;
		}
		else{
			$this->folder->component_type = $component_type;
		}

        $this->folder->save();
		return($this->folder);
	}

	public function getFoldersByParentId($parent_id){
		return $this->folder::where('parent_id',$parent_id)->get();
	}

	public function getFolder($folder_id){
		return($this->folder::find($folder_id));
	}

	public function saveContent($content, $container_id, $content_id = '') {
		// save in existing content_id if set, otherwise, create new
		if($this->validateContent($content)){
			$container = $this->container::find($container_id);
			if($content_id == ''){
				$myContent = new $this->content;
			} else {
				$myContent = $this->content::find($content_id);
				//dd($myContent);
			}
        	$myContent->content = $content;
        	$myContent->save();
        	$container->contents()->save($myContent);
			return $myContent->_id;	
		}
	}

	private function validateContent($content){
		return true;
	}
}