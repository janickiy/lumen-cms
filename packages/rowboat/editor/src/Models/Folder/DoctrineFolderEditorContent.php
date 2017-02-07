<?php

namespace Rowboat\Editor\Models\Folder;

use Rowboat\Editor\Models\Component\Doctrine\DoctrineComponentEditorContent;


class DoctrineFolderEditorContent extends DoctrineComponentEditorContent implements FolderEditorContentInterface
{
	 protected $model = 'Rowboat\Editor\Models\Component\Doctrine\Folder';

	public function container()
    {
        // return $this->belongsTo('Rowboat\Core\Models\Template\DoctrineTemplateContainer',null,'container_id');
        return '';
    }

    public function getLatestContentByContainerId($container_id)
    {
    	// $contents = $this->where('container_id',$container_id)->get();
		// if($contents->count()){
		// 	return($contents->last()->content);
		// } else {
		// 	return('');
		// }
        $contents = $this->dm->getRepository($this->model)->findBy(
                    array(  'container_id' => $container_id));
        if($contents->count()){
            return($contents->last()->content);
        } else {
            return('');
        }
    } 


    public function folder()
    {
        // return $this->belongsTo('Rowboat\Editor\Models\ComponentEditorFolder',null,'folder_id');
    
        return '';
    }
}
