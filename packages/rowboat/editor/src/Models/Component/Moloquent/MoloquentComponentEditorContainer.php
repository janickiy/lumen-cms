<?php

namespace Rowboat\Editor\Models\Component\Moloquent;

use Rowboat\Core\Models\Component\Moloquent\MoloquentComponentContainer;
use Rowboat\Editor\Models\Template\Moloquent\MoloquentTemplateEditorContent;
use Rowboat\Editor\Models\Component\ComponentEditorContainerInterface;
use DB;

abstract class MoloquentComponentEditorContainer extends MoloquentComponentContainer implements ComponentEditorContainerInterface {
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
    protected $content;

    public function __construct() {
        $this->content = new MoloquentTemplateEditorContent;
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return Rowboat\Core\Models\MoloquentComponentContainer
     */
    //public function createContainer(array $attributes = [])
    public static function createContainer($name) {
        // this will retun a new object, and can be called statically
        $model = new static();
        $model->setName($name);
        //dd($model);
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
    public static function deleteContainer($container_id) {
        // todo: we should delete all contents too
        $model = self::find($container_id);
        DB::beginTransaction();
        try {
            $model->contents()->delete();
            $model->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getContentById($content_id) {
        // look up content by id.
        // first we need a content model
        return $this->content->find($content_id);
    }

    public function updateContent($content, $content_id) {
        $item = $this->content;
        $item = $item->find($content_id);
        //dd($content_id);
        $item->content = $content;
        return $item->save();
    }

    public function addContent($container_id, $content) {
        $model = self::find($container_id);
        return $this->content->addNewVersion($content, $model);
        /* $model = self::find($container_id);
          $item = $this->content;
          $item->description = $content;
          return $model->contents()->save($item); */
    }

    public function removeContent($content_id) {
        return $this->content->find($content_id)->delete();
    }

}
