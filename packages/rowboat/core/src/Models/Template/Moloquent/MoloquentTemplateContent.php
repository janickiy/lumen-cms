<?php

namespace Rowboat\Core\Models\Template\Moloquent;

use Rowboat\Core\Models\Component\Moloquent\MoloquentComponentContent;

class MoloquentTemplateContent extends MoloquentComponentContent implements TemplateContentInterface
{
    protected $collection = 'build.templates.content';

	public function container()
    {
        return $this->belongsTo('Rowboat\Core\Models\Template\MoloquentTemplateContainer',null,'container_id');
    }

}
