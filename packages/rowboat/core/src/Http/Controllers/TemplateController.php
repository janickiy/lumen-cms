<?php

namespace Rowboat\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rowboat\Core\View\Engines\DbPhpEngine;
use Rowboat\Core\Repositories\TemplateRepository;

use App\Http\Requests;

class TemplateController extends ViewController
{

    protected $template;

    public function __construct(TemplateRepository $repository){
        parent::__construct($repository);
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
        // when is compileString called normally? we should call from overridden class.
        $compiled = \Blade::compileString($content);
        // add DbPhpEngine to the available Engines with the factory methods, use if no extension. Need to not search for files in filesystem...
        $render = new DbPhpEngine;
        return($render->get($compiled, ['var' => 'value']));
    }

}

