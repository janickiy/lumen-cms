<?php
namespace Rowboat\Core\Models\Component\Doctrine;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Events;
/**
 * @ODM\MappedSuperclass
 * @ODM\HasLifecycleCallbacks
 */
abstract class Base
{
    /** @ODM\Id */
    public $_id;

    /** @ODM\Field (name="created_at",type="date")*/
    public $createdAt;
    
    /** @ODM\Field (name="updated_at",type="date")*/
    public $updatedAt;

    /** @ODM\PrePersist */
    public function prePersist(\Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs)
    {
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    /** @ODM\PreUpdate */
    public function preUpdate(\Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs)
    {
        echo 'preUpdate';
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function __construct()
    {
    }
    public function getId()
    {
        return $this->_id;
    }
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set updatedAt
     *
     * @param date $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
