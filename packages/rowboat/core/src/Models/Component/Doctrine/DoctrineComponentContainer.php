<?php

namespace Rowboat\Core\Models\Component\Doctrine;

use Rowboat\Core\Models\Component\Doctrine\DoctrineComponent as DoctrineComponent;
use Rowboat\Core\Models\Template\DoctrineTemplateContent;

abstract class DoctrineComponentContainer extends DoctrineComponent
{
    protected $model = 'Rowboat\Core\Models\Component\Doctrine\Container';

    public function getContainersByFolderId($folder_id){
    	// return $this->where('folder_id',$folder_id)->get()->toArray();
        return $this->dm->getRepository($this->model)->findBy(
                    array(  'folder_id' => $folder_id));
        $this->content = \App::make('Rowboat\Core\Models\Template\DoctrineTemplateContent');
    }

    public function getContainerById($container_id)
    {
        // return($this->where('_id', $container_id))->first()->toArray();
        return $this->dm->getRepository($this->model)->findOneBy(
                    array(  '_id' => $container_id));
    }

    public function save(){
        $container = new Container($this->name);
        if(isset($this->folder_id)){
            $container->setFolderId($this->folder_id);
            
        }
        if(isset($this->component_type)){
            $container->setComponentType($this->component_type);
        }
        $this->dm->persist($container);
        $this->dm->flush();
        $this->_id = $container->getId();
    }
    
    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return Rowboat\Core\Models\DoctrineComponentContainer
     */
    //public function createContainer(array $attributes = [])
    public static function getContainer($container_id)
    {
        $model = new static();
        return $model->getContainerById($container_id);
    }

    public function delete($container_id){
        $result = $this->dm->createQueryBuilder($this->model)
            ->remove()
            ->field('_id')->equals($container_id)
            ->getQuery()
            ->execute();
        if( isset($result) && isset($result['n']) && $result['n']!='0' ){
            return true;
        }else{
            return false;
        }
    }

    public function getLatestContentByContainerId($container_id){
		return $this->content->getLatestContentByContainerId($container_id);
    } 

	public function getContentsByContainerId($container_id){
		return $this->content->getContentsByContainerId($container_id);
    } 

    public function getContentById($content_id){
		return $this->content->getContentById($content_id);
    }

}
