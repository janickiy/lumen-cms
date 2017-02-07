<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Rowboat\Editor\Models\Template\Doctrine\DoctrineTemplateEditorContainer;
//use Rowboat\Editor\Repositories\TemplateEditorRepository;

class DoctrineTemplateTest extends TestCase
{
    /**
     * A basic instantiation test.
     *
     * @return void
     */
    public function test_can_instantiate_doctrine_template_container()
    {
        //dd($this->app);
    	//$container = new TemplateEditorContainerInterface;
        $container = new DoctrineTemplateEditorContainer;

        //$container = new Rowboat\Editor\Repositories\TemplateEditorRepository;
        //$container = new TemplateEditorRepository;
        $name = 'this is my test container';
        $resultContainer = $container->createContainer($name);
        $result_id = $resultContainer->_id;
        // $this->assertStringMatchesFormat('%x',$result_id);
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
    public function test_can_get_content()
    {
        $container = new DoctrineTemplateEditorContainer;
        $foundContainer = $container->getContainer('5892ea389a89204b2f027172');
       // $results = $foundContainer->getContentById('587b6d7d9a8920060d0723f7');
        $this->assertNull($foundContainer);
        // $container for editor is not inherited from core... need to fix.
        
       //$this->expectException($foundContainer->getContents());
        //dd($results);
      //  $this->assertNotNull($results);
    }

    /**
     * A test example.
     *
     * @return void
     */
    public function test_can_instantiate_all_containers()
    {
        $container = new DoctrineTemplateEditorContainer;
        //$container = new Rowboat\Editor\Repositories\TemplateEditorRepository;
        //$container = new TemplateEditorRepository;
        $name = 'this is my new container';
       // $result = $container->createContainer($name);

       // $this->assertStringMatchesFormat('%x',$result->_id);
       // $this->assertEquals($name, $result->name);


    }

    /**
     * A test example.
     *
     * @return void
     */
    public function test_can_instantiate_content()
    {
        $container = new DoctrineTemplateEditorContainer;
        $name = 'this is my test container';
        $resultContainer = $container->createContainer($name);
        $result_id = $resultContainer->_id;
        $this->assertEquals($name, $resultContainer->name);

        // look up by container_id
        $foundContainer = $container->getContainer($result_id);
        $this->assertEquals($name, $foundContainer->name);

        // add new content by container_id
        $mycontent = 'this is my test content';
        $content = $container->addContentNewVersion($mycontent,$result_id);
        $this->assertEquals($mycontent, $content->content);

        // look up by content_id
        $foundContent = $container->getContentById($content->_id);
        $this->assertEquals($content->_id, $foundContent->_id);

        // check container of content
        $parentContainer =  $foundContent->getContainer();
        $this->assertEquals($resultContainer->_id, $parentContainer->_id);

        // check update content
        $mycontentUpdate = 'this is my test update';
        $contentUpdate = $container->updateContent($mycontentUpdate,$content->_id);

        $foundContent = $container->getContentById($content->_id);
        $this->assertEquals($mycontentUpdate,$foundContent->content);

        // delete container check delete content
        $deleteResult = $container->deleteContainer($result_id);
        $this->assertTrue($deleteResult);

        $removeContent = $container->getContentById($content->_id);
        $this->assertNull($removeContent);

    }


}
