<?php

namespace Rowboat\Core\Models\Component\Doctrine;

use Doctrine\ODM\MongoDB\DocumentManager;

class DoctrineComponent
{
    protected $dm;

    protected $model = 'Base';

    public function __construct(){
        $this->dm = app('Doctrine\ODM\MongoDB\DocumentManager');
    }
    
    

}
