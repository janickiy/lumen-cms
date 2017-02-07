<?php

namespace Rowboat\Editor\Repositories;

use Rowboat\Editor\Models\Component\ComponentEditorContainerInterface;

abstract class ComponentEditorRepository extends \Rowboat\Core\Repositories\ComponentRepository implements ComponentEditorRepositoryInterface 
{

	public function __construct( ComponentEditorContainerInterface $container)
	{
		parent::__construct($container);
    }

	public function getContainersByFolderId($folder_id)
	{
		return $this->converListObjectToArrayJson($this->container->getContainersByFolderId($folder_id));	
	}

	public function addContainer(ComponentEditorContainerInterface $container)
	{
		$container->save();	
	}

	public function addContent($content, $container_id, $content_id='')
	{
		if($content_id==''){
			$this->container->addContentNewVersion($content, $container_id);
		}else{
			$this->container->updateContent($content, $content_id);
		}
	}
}