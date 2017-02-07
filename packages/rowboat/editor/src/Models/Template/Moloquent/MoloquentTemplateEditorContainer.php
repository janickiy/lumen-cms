<?php

namespace Rowboat\Editor\Models\Template\Moloquent;

use Rowboat\Editor\Models\Component\Moloquent\MoloquentComponentEditorContainer;
use Rowboat\Editor\Models\Template\TemplateEditorContainerInterface;

class MoloquentTemplateEditorContainer extends MoloquentComponentEditorContainer implements TemplateEditorContainerInterface
{
    protected $collection = 'build.templates.container';

    public function contents()
    {
        return $this->hasMany('Rowboat\Editor\Models\Template\Moloquent\MoloquentTemplateEditorContent', 'container_id');
    }


}
