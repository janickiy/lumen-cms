<?php

namespace Rowboat\Core\Repositories;

use Rowboat\Core\Models\Component\ComponentContainerInterface;

abstract class ComponentRepository implements ComponentRepositoryInterface {

	protected $container;


    public function __construct(ComponentContainerInterface $container){
		$this->container = $container;

    }


	public function getContentById($content_id=''){
		$content = $this->container->getContentById($content_id);
		return ($this->converObjectToJson($content));
	}

	public function getLatestContentByContainerId($container_id){
		return $this->converObjectToJson($this->container->getLatestContentByContainerId($container_id));
	}

	public function getContainer($container_id){
		return $this->converObjectToJson($this->container->getContainerById($container_id));	
	}

	public function converListObjectToArrayJson($dataList){
		$list = array();
		foreach($dataList as $data){
			$obj = $this->converObjectToJson($data);
			$list [] = $obj;
		}
		return $list;
	}

	public function converObjectToJson($data){
		return json_decode(json_encode($data), True);
	}

}