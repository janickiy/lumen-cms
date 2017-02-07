<?php

namespace Rowboat\Core\Models\Component\Moloquent;

use Rowboat\Core\Models\Component\ComponentContainerInterface;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent; 

abstract class MoloquentComponentContainer extends Moloquent implements ComponentContainerInterface
{
	protected $connection = 'mongodb';
	public $timestamps = true;

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
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return Rowboat\Core\Models\MoloquentComponentContainer
     */
    //public function createContainer(array $attributes = [])
    public static function getContainer($container_id)
    {
        // this will retun a new object, and can be called statically
       // $model = new static();
        $model = self::find($container_id);
        return $model;

    }



}
