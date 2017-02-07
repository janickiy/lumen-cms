<?php

namespace Rowboat\Core\Models\Component\Doctrine;

use Rowboat\Core\Models\Component\Doctrine\DoctrineComponent as DoctrineComponent;

abstract class DoctrineComponentContent extends DoctrineComponent
{
	protected $model = 'Rowboat\Core\Models\Component\Doctrine\Content';

    public function getLatestContentByContainerId($container_id){
		$contents = $this->dm->getRepository($this->model)->findBy(
                    array(  'container_id' => $container_id),
					array(  '_id' => 'DES'));
		if(!empty($contents)){
			return reset($contents)->getContent();
		} else {
			return('');
		}
    } 

	public function getContentsByContainerId($container_id){
		return $this->dm->getRepository($this->model)->findBy(
                    array(  'container_id' => $container_id),
					array(  '_id' => 'DES'));
    } 

    public function getContentById($content_id){
		return $this->dm->getRepository($this->model)->findOneBy(
                    array(  '_id' => $content_id));
    }
	public function save(){
        $contentObj = new Content();
		$contentObj->setContent($this->content);
        $contentObj->setContainerId($this->container_id);
		$contentObj->setContainer($this->container);
        $this->dm->persist($contentObj);
        $this->dm->flush();
        $this->_id = $contentObj->getId();
    }

	public function update($content, $content_id){
		$contentObj = $this->dm->createQueryBuilder($this->model)
			->findAndUpdate()
			->returnNew()
			->field('_id')->equals($content_id)

			->field('content')->set($content)
			->getQuery()
			->execute();

		return $contentObj;
	}

	public function deleteByContainerId($container_id){
		$result = $this->dm->createQueryBuilder($this->model)
            ->remove()
            ->field('container_id')->equals($container_id)
            ->getQuery()
            ->execute();
        if( isset($result) && isset($result['n']) && $result['n']!='0' ){
            return true;
        }else{
            return false;
        }
	}
	public function delete($content_id){
		$result = $this->dm->createQueryBuilder($this->model)
            ->remove()
            ->field('_id')->equals($content_id)
            ->getQuery()
            ->execute();
        if( isset($result) && isset($result['n']) && $result['n']!='0' ){
            return true;
        }else{
            return false;
        }
	}
}
