<?php
namespace Rowboat\Core\Models\Component\Doctrine;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

 /**
 * @ODM\Document(collection="build.templates.content")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 */
class Content extends Base
{
    /** @ODM\Field(type="string") */
    public $content;

    /** @ODM\Field(type="string") */
    public $container_id;

    /** @ODM\ReferenceOne(targetDocument="Rowboat\Core\Models\Component\Doctrine\Container", inversedBy="contents") */
    public $container;

    public function __construct()
    {

    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContainerId($container_id)
    {
        $this->container_id = $container_id;
    }
    public function getContainerId()
    {
        return $this->container_id;
    }
    public function setContainer($container)
    {
        $this->container = $container;
    }
    public function getContainer()
    {
        return $this->container;
    }
    public function __toString()
    {
        return (string) $this->content;
    }

}
