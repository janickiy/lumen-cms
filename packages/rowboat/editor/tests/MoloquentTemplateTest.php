<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Rowboat\Editor\Models\Template\Moloquent\MoloquentTemplateEditorContainer;
use Rowboat\Editor\Models\Template\Moloquent\MoloquentTemplateEditorContent;

class ViewPageTest extends TestCase
{
//    use DatabaseMigrations, DatabaseTransactions;
    /**
     * A basic instantiation test.
     *
     * @return void
     */
    private $faker;
    public function __construct() {
        $this->faker = Faker\Factory::create();
    }
    
    public function test_can_instantiate_moloquent_template_container()
    {
        //dd($this->app);
    	//$container = new TemplateEditorContainerInterface;
        $container = new MoloquentTemplateEditorContainer;
        //$container = new Rowboat\Editor\Repositories\TemplateEditorRepository;
        
        //$container = new TemplateEditorRepository;
        $name = $this->faker->name;
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
        $name = $this->faker->name;
        $result = $container->createContainer($name);

        $this->assertStringMatchesFormat('%x',$result->_id);
        $this->assertEquals($name, $result->name);
    }
    
    /**
     * Get contents of first container.
     *
     * @return void
     */
    public function test_can_get_contents()
    {
        $container = MoloquentTemplateEditorContainer::first();
       // dd($con);
        //$con = MoloquentTemplateEditorContainer::first();
        $results = $container->contents()->get();
        $this->assertNotNull($results);
        //$this->see('Walk');
    }

    /**
     * Add a content item to first container
     *
     * @return void
     */
    public function test_can_add_content()
    {
        $container = new MoloquentTemplateEditorContainer;
        $container_id = $container->first()->_id;
        $content = $this->faker->text;
        $result = $container->addContent($container_id, $content);
        $this->assertNotFalse($result);
    }
    
    /**
     * Remove first content item of first container
     *
     * @return void
     */
    public function test_can_remove_content()
    {
        $container = new MoloquentTemplateEditorContainer;
        $firstContainer = $container->first();
        $firstContentId = $firstContainer->contents()->first()->_id;
        $result = $container->removeContent($firstContentId);
        //$this->assertEquals($content_id, '5894301701680c1b74003c43');
        $this->assertTrue($result);
    }
    
    /**
     * Update last content item of first container
     *
     * @return void
     */
/*    public function test_can_update_content()
    {
        $container = new MoloquentTemplateEditorContainer;
        $firstContainer = $container->first();
        $firstContentId = $firstContainer->contents()->first()->_id;
        $result = $container->updateContent($this->faker->text, $firstContentId);
        $this->assertTrue($result);
    }
  */  
    /**
     * Remove last container and his contents.
     *
     * @return void
     */
    public function test_can_remove_containers()
    {
        $container = new MoloquentTemplateEditorContainer;
        $id = $container->orderBy('created_at', 'desc')->first()->_id;
        $result2 = $container->deleteContainer($id);
        $this->assertTrue($result2);
    }
    
    
    
}
