<?php

namespace Rowboat\Core\Models\Component\Moloquent;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent; 

abstract class MoloquentComponentContent extends Moloquent 
{
	protected $connection = 'mongodb';
	public $timestamps = true;

    public function getLatestContentByContainerId($container_id)
    {
    	$contents = $this->where('container_id',$container_id)->get();
		if($contents->count()){
			return($contents->last()->content);
		} else {
			return('');
		}
    } 

    public function getContentById($content_id)
    {
    	return($this->where('_id', $content_id)->first()->toArray());
    }
}
