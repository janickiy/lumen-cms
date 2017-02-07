<?php

namespace Rowboat\Editor\Repositories;

use \Rowboat\Editor\Repositories\TemplateEditorRepository;
use \Rowboat\Editor\Models\Template\TemplateEditorContainerInterface;


class TemplateEditorRepository extends ComponentEditorRepository {

	public function __construct(TemplateEditorContainerInterface $container)
	{
		parent::__construct($container);
    }
    
}