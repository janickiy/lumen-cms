<?php

namespace Rowboat\Core\Models\Template\Moloquent;

use Rowboat\Core\Models\Component\Moloquent\MoloquentComponentContainer;

class MoloquentTemplateContainer extends MoloquentComponentContainer implements TemplateContainerInterface
{
    protected $collection = 'build.templates.container';

	public function contents()
    {
        return $this->hasMany('Rowboat\Core\Models\Template\Moloquent\MoloquentTemplateContent', 'container_id');
    }


}
