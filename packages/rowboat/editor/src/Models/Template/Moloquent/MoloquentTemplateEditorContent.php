<?php

namespace Rowboat\Editor\Models\Template\Moloquent;

use Rowboat\Editor\Models\Component\Moloquent\MoloquentComponentEditorContent;



class MoloquentTemplateEditorContent extends MoloquentComponentEditorContent 
{
    protected $collection = 'build.templates.content';

	public function container()
    {
        return $this->belongsTo('Rowboat\Core\Models\Template\MoloquentTemplateContainer',null,'container_id');
    }

    public function folder()
    {
        return $this->belongsTo('Rowboat\Editor\Models\ComponentEditorFolder',null,'folder_id');
    }

}
