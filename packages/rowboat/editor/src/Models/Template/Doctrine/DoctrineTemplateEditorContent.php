<?php

namespace Rowboat\Editor\Models\Template\Doctrine;

use Rowboat\Editor\Models\Component\Doctrine\DoctrineComponentEditorContent;



class DoctrineTemplateEditorContent extends DoctrineComponentEditorContent 
{
    protected $collection = 'build.templates.content';

	public function container()
    {
        return '';
        // return $this->belongsTo('Rowboat\Core\Models\Template\DoctrineTemplateContainer',null,'container_id');
    }

    public function folder()
    {
        return '';
        // return $this->belongsTo('Rowboat\Editor\Models\ComponentEditorFolder',null,'folder_id');
    }

}
