<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Rowboat\Editor\Entities\Template\Moloquent\MoloquentTemplateEditorContainer;
//use Rowboat\Editor\Repositories\TemplateEditorRepository;

class ViewPageTest extends TestCase
{
    /**
     * A basic instantiation test.
     *
     * @return void
     */
    public function test_can_instantiate_container()
    {
        //dd($this->app);
    	//$container = new TemplateEditorContainerInterface;
        $container = new MoloquentTemplateEditorContainer;

        //$container = new Rowboat\Editor\Repositories\TemplateEditorRepository;
        //$container = new TemplateEditorRepository;
        $name = 'this is my test container';
        $resultContainer = $container->createContainer($name);
        $result_id = $resultContainer->_id;
        $this->assertStringMatchesFormat('%x',$result_id);
        $this->assertEquals($name, $resultContainer->name);
        //dd($resultContainer->content);

        // look up by container_id
        $foundContainer = $container->getContainer($result_id);
        $this->assertEquals($name, $foundContainer->name);

        // delete the container
        $deleteResult = $container->deleteContainer($result_id);
        $this->assertTrue($deleteResult);

        // make sure container no longer exists
        $removedContainer = $container->getContainer($result_id);
        $this->assertNull($removedContainer);


    }

    /**
     * A test example.
     *
     * @return void
     */
    public function test_can_instantiate_all_containers()
    {
        $container = new MoloquentTemplateEditorContainer;
        //$container = new Rowboat\Editor\Repositories\TemplateEditorRepository;
        //$container = new TemplateEditorRepository;
        $name = 'this is my new container';
       // $result = $container->createContainer($name);

       // $this->assertStringMatchesFormat('%x',$result->_id);
       // $this->assertEquals($name, $result->name);


    }
}
