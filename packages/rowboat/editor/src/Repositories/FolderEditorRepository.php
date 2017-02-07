<?php

namespace Rowboat\Editor\Repositories;

use \Rowboat\Editor\Models\Folder\FolderEditorContainerInterface;
use \Rowboat\Editor\Models\Folder\FolderEditorContentInterface;

class FolderEditorRepository extends ComponentEditorRepository {

	public function __construct(FolderEditorContainerInterface $container, FolderEditorContentInterface $content)
	{
		parent::__construct($container, $content);
    }

    public function getAllByComponent($component){
    	return($this->container->getAllFoldersByComponent($component));
    }

    public function getAllNestedFoldersByComponent($component, $folder_id='root'){
    	return($this->container->getAllNestedFoldersByComponent($component, $folder_id));
    }

	public function getAllNestedFoldersByComponentTrackOpenFolders($component, $folder_id='root', $selected_folder_id){
		$folders = $this->getAllNestedFoldersByComponent($component, $folder_id);
		$folders = $this->converListObjectToArrayJson($folders);
		$this->trackOpenFolders($folders, $selected_folder_id);
		return($folders);

    }

    private function trackOpenFolders(Array &$array, $selected_folder_id)
    {
    	// recursivily search for selected folder, open each folder, then close when not found
    	for($i=0; $i<count($array); $i++){
    		if(is_array($array[$i])){
    			$array[$i]['state'] = 'open';
    			if(isset($array[$i]['_id']) && $array[$i]['_id'] == $selected_folder_id){
    				return true;
    			}
    			if(!isset($array[$i]['children']) OR !$this->trackOpenFolders($array[$i]['children'], $selected_folder_id)){
    				$array[$i]['state'] = 'closed';
    			}
   			} else {
   				return false;
   			}
   		}
    }

    public function getFolderById($id){
    	return($this->container->getFolderById($id));
    }
    
}