<?php

namespace Rowboat\Core\Repositories;

interface ComponentRepositoryInterface {

	//public function getAll();

	public function getContainer($id);

	public function getContentById($id);

}