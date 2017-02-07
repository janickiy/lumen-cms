<?php

namespace Rowboat\Editor\Models\Folder;

use Rowboat\Editor\Models\MoloquentComponentEditorContent;


class MoloquentFolderEditorContent extends MoloquentComponentEditorContent implements FolderEditorContentInterface
{
	protected $collection = 'build.component.folder';

	public function container()
    {
        return $this->belongsTo('Rowboat\Core\Models\Template\MoloquentTemplateContainer',null,'container_id');
    }

    public function getLatestContentByContainerId($container_id)
    {
    	$contents = $this->where('container_id',$container_id)->get();
		if($contents->count()){
			return($contents->last()->content);
		} else {
			return('');
		}
    } 


    public function folder()
    {
        return $this->belongsTo('Rowboat\Editor\Models\ComponentEditorFolder',null,'folder_id');
    }
}
