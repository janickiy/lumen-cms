<?php

namespace Rowboat\Editor\Models\Component;

use Rowboat\Core\Models\Component\ComponentContainerInterface;


interface ComponentEditorContainerInterface extends ComponentContainerInterface
{
	//public function folder();



	public static function createContainer($name);

	public function getName();

	public function getContentById($content_id);

	public function updateContent($content, $content_id);

}
