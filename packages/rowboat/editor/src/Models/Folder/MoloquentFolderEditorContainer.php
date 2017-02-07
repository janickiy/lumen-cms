<?php

namespace Rowboat\Editor\Models\Folder;

use Rowboat\Editor\Models\MoloquentComponentEditorContainer;

class MoloquentFolderEditorContainer extends MoloquentComponentEditorContainer implements FolderEditorContainerInterface
{
	protected $collection = 'build.component.folder';
	protected $connection = 'mongodb';
	public $timestamps = true;

	public function contents()
    {
        return $this->hasMany('Rowboat\Core\Models\Folder\MoloquentFolderEditorContent', 'container_id');
    }

    public function getContainersByFolderId($folder_id){
    	return $this->where('folder_id',$folder_id)->get()->toArray();
    }


    public function folder()
    {
        return $this->belongsTo('Rowboat\Editor\Models\Folder\MoloquentFolderEditorContainer',null,'folder_id');
    }

    public function getAllFoldersByComponent($component)
    {
    	return $this->where('component_type', $component)->get()->toArray();
    }

    public function getFolderById($id)
    {
    	return $this->where('_id', $id)->get()->toArray();
    }

    public function getAllNestedFoldersByComponent($component, $folder_id='root')
    {
    	$folders = $this->where('component_type', $component)->where('folder_id', $folder_id)->get()->toArray();
    	$results = array();
    	foreach($folders as $folder){
    		$children = $this->getAllNestedFoldersByComponent($component, $folder['_id']);
    		if($children){
    			$folder['children'] = $children;
    		}
    		$results[] = $folder;
    	}
    	return($results);
    }
}
