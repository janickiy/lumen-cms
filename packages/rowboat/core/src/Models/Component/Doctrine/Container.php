<?php
namespace Rowboat\Core\Models\Component\Doctrine;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

 /**
 * @ODM\Document(collection="build.templates.container")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 */
class Container extends Base
{
    /** @ODM\Field(type="string") */
    public $name;

    /** @ODM\ReferenceMany(targetDocument="Rowboat\Core\Models\Component\Doctrine\Content", mappedBy="container") */
    public $contents;

    /** @ODM\Field(type="string") */
    public $folder_id;

    /** @ODM\Field(type="string") */
    public $component_type;

    public function __construct($name)
    {
        $this->name = $name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setFolderId($folder_id)
    {
        $this->folder_id = $folder_id;
    }
    public function getFolderId()
    {
        return $this->folder_id;
    }
    public function setComponentType($component_type)
    {
        $this->component_type = $component_type;
    }
    public function getComponentType()
    {
        return $this->component_type;
    }
    public function setContents($contents)
    {
        $this->contents = $contents;
    }
    public function getContents()
    {
        return $this->contents;
    }
    public function __toString()
    {
        return (string) $this->name;
    }

}
