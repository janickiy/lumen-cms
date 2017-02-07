<?php

namespace Rowboat\Editor\Models\Component\Doctrine;

use Rowboat\Core\Models\Component\Doctrine\DoctrineComponentContainer;
use Rowboat\Editor\Models\Template\Doctrine\DoctrineTemplateEditorContent;
use Rowboat\Editor\Models\Component\ComponentEditorContainerInterface;
abstract class DoctrineComponentEditorContainer extends DoctrineComponentContainer implements ComponentEditorContainerInterface
{
    /**
     * The content.
     *
     * @var \Illuminate\Database\Query\Builder
     */
    protected $content;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $content_attributes;

    /**
     * The model being queried.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $content_data;

     /**
     * The model being queried.
     *
     * @var string 
     */
    //protected $name;

    /**
     * Create a new Eloquent query builder instance.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return void
     */
    public function __construct()
    {
        $this->content = new DoctrineTemplateEditorContent;
        parent::__construct();
    }

	/**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return Rowboat\Core\Models\MoloquentComponentContainer
     */
    //public function createContainer(array $attributes = [])
    public static function createContainer($name)
    {
        // this will retun a new object, and can be called statically
        $model = new static();
        $model->setName($name);
        $model->save();
        return $model;
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return Rowboat\Core\Models\MoloquentComponentContainer
     */
    //public function createContainer(array $attributes = [])
    public static function deleteContainer($container_id)
    {
        // todo: we should delete all contents too
        
        $model = new static();
        $contents = $model->content->getContentsByContainerId($container_id);
        $result = true;
        if(!empty($contents)){
             $result = $model->content->deleteByContainerId($container_id);
        }
        if($result){
            $result = $model->delete($container_id);
        }
        return $result;

        
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getContentById($content_id)
    {
        // look up content by id.
        // first we need a content model
        return $this->content->getContentById($content_id);
    }

    public function getLatestContentByContainerId($container_id)
    {
        return $this->content->getLatestContentByContainerId($container_id);
    }

    public function updateContent($content, $content_id)
    {
        return $this->content->update($content, $content_id);
    }
    public function addContentNewVersion($content, $container_id)
    {
        return $this->content->addNewVersion($content, $container_id);
    }
}
