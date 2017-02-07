<?php

namespace Rowboat\Core\Repositories;

use \Rowboat\Core\Models\Template\TemplateContainerInterface;


class TemplateRepository extends ComponentRepository {

    public function __construct(TemplateContainerInterface $container){
        parent::__construct($container);
    }

	public function test(){
		//return(TemplateContainer::all());
		return(false);
	}

}