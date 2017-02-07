<?php
namespace Rowboat\Core\Models\Component;

trait ComponentContainer
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
    /**
     * Create a new access response.
     *
     * @param  string|null  $message
     * @return \Illuminate\Auth\Access\Response
     */
    protected function allow($message = null)
    {
        return new Response($message);
    }
    /**
     * Throws an unauthorized exception.
     *
     * @param  string  $message
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function deny($message = 'This action is unauthorized.')
    {
        throw new AuthorizationException($message);
    }
}