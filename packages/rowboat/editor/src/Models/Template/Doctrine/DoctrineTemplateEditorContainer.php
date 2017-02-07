<?php

namespace Rowboat\Editor\Models\Template\Doctrine;

use Rowboat\Editor\Models\Component\Doctrine\DoctrineComponentEditorContainer;
use Rowboat\Editor\Models\Template\TemplateEditorContainerInterface;

class DoctrineTemplateEditorContainer extends DoctrineComponentEditorContainer implements TemplateEditorContainerInterface
{
    protected $collection = 'build.templates.container';

	public function contents()
    {
        return '';
        // return $this->hasMany('Rowboat\Core\Models\Template\DoctrineTemplateContent', 'container_id');
    }

    public function folder()
    {
        return '';
        // return $this->belongsTo('Rowboat\Editor\Models\ComponentEditorFolder',null,'folder_id');
    }

}
