<?php

namespace Rowboat\Editor\Models\Component\Doctrine;

use Rowboat\Core\Models\Component\Doctrine\DoctrineComponentContent;
use Rowboat\Editor\Models\Template\Doctrine\DoctrineTemplateEditorContainer;



abstract class DoctrineComponentEditorContent extends DoctrineComponentContent
{

	public function addNewVersion($content, $container_id)
	{
                
        $myContent = $this;
        $myContent->content = $content;
        $myContent->container_id = $container_id;
        $myContainer = new DoctrineTemplateEditorContainer;
        $container = $myContainer->getContainerById($container_id);
        $myContent->container = $container;
        $myContent->save();

        return $this;


	}


}
