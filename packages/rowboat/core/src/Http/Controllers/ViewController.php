<?php

namespace Rowboat\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\Compilers\BladeCompile;

use Rowboat\Core\Repositories\ComponentRepositoryInterface;

abstract class ViewController extends Controller
{

    protected $repository;

    public function __construct(ComponentRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    return view('editor::scaffold.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = $this->repository->getLatestContentByContainerId($id);
        return($content);
    }

}
