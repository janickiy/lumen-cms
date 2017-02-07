<?php
namespace Rowboat\Editor\Models\Component\Doctrine;
use Rowboat\Core\Models\Component\Doctrine\Base;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

 /**
 * @ODM\Document(collection="build.component.folder")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 */
class Folder extends Base
{
    /** @ODM\Field(type="string") */
    public $name;

    /** @ODM\Field(type="string") */
    public $folder_id;

    /** @ODM\Field(type="string") */
    public $component_type;

    public $children;

    public $state = "closed";

    // /** @ReferenceMany(targetDocument="Rowboat\Core\Models\Content", mappedBy="container") */
    // private $containers;

    public function __construct($name,$component_type,$folder_id)
    {
        $this->name = $name;
        $this->component_type = $component_type;
        $this->folder_id = $folder_id;
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
    public function setChildren($children)
    {
        $this->children = $children;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function setState($state)
    {
        $this->state = $state;
    }
    public function getState()
    {
        if(!isset($this->state)){
            return "closed";
        }
        return $this->state;
    }
    public function __toString()
    {
        return (string) $this->name;
    }
    

}
