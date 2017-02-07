<?php

namespace Rowboat\Editor\Http\Controllers;

use Rowboat\Editor\Repositories\TemplateEditorRepository;
use Rowboat\Editor\Repositories\FolderEditorRepository;
use Rowboat\Editor\Models\Template\TemplateEditorContainerInterface;

class TemplateEditorController extends EditorController
{


    public function __construct(TemplateEditorRepository $repository, FolderEditorRepository $folder, TemplateEditorContainerInterface $container){
        parent::__construct($repository, $folder, $container);
        $this->container_type = 'template';
        view()->share('container_type', $this->container_type);
        view()->share('component_type', $this->container_type);
    }
	
	public function testonly() {
		return 'test only';
	}
    
}
