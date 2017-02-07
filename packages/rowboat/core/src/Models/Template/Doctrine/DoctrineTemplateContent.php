<?php

namespace Rowboat\Core\Models\Template;

use Rowboat\Core\Models\DoctrineComponentContent;

class DoctrineTemplateContent extends DoctrineComponentContent
{
    

	public function container()
    {
        // return $this->belongsTo('Rowboat\Core\Models\Template\DoctrineTemplateContainer',null,'container_id');
        return '';
    }

}
