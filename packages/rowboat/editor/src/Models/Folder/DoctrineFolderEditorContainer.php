<?php

namespace Rowboat\Editor\Models\Folder;

use Rowboat\Editor\Models\Component\Doctrine\DoctrineComponentEditorContainer;


class DoctrineFolderEditorContainer extends DoctrineComponentEditorContainer implements FolderEditorContainerInterface
{
    protected $model = 'Rowboat\Editor\Models\Component\Doctrine\Folder';
	public function contents()
    {
        return '';
        // return $this->hasMany('Rowboat\Core\Models\Folder\DoctrineFolderEditorContent', 'container_id');
    }

    public function getContainersByFolderId($folder_id){

    	// return $this->where('folder_id',$folder_id)->get()->toArray();
        return $this->dm->getRepository($this->model)->findBy(
                    array(  'folder_id' => $folder_id));
    }


    public function folder()
    {
        return '';
        // return $this->belongsTo('Rowboat\Editor\Models\Folder\DoctrineFolderEditorContainer',null,'folder_id');
    }

    public function getAllFoldersByComponent($component)
    {
        
    	// return $this->where('component_type', $component)->get()->toArray();
        return $this->dm->getRepository($this->model)->findBy(
                    array(  'component_type' => $component));
    }

    public function getFolderById($id)
    {

    	// return $this->where('_id', $id)->get()->toArray();
       return $this->dm->find($this->model,$id);
    }

    public function getAllNestedFoldersByComponent($component, $folder_id='root')
    {
        // dd($this->model);
        $folders = $this->dm->getRepository($this->model)->findBy(
                    array(  'component_type' => $component,
                            'folder_id'=> $folder_id));
        $results = array();
        foreach($folders as $folder){
            $children = $this->getAllNestedFoldersByComponent($component, $folder->getId());
            if($children){
                $folder->setChildren($children);
            }
            $results[] = $folder;
        }
    	return($results);
    }
}
