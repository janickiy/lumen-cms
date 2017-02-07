<?php

namespace Rowboat\Core\Models\Template;

use Rowboat\Core\Models\DoctrineComponentContainer;

class DoctrineTemplateContainer extends DoctrineComponentContainer implements TemplateContainerInterface
{


	public function contents()
    {
        return '';
        // return $this->hasMany('Rowboat\Core\Models\Template\DoctrineTemplateContent', 'container_id');
    }

    


}
