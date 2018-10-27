<?php
/**
 * Office note entity.
 *
 */

namespace OpenEMR\Entities;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn   ;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @Table(name="onotes")
 * @Entity(repositoryClass="OpenEMR\Repositories\ONoteRepository")
 */
class ONote
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @Column(name="body", type="text")
     */
    private $body;

    /**
     * @Column(name="groupname", type="string", length=255)
     */
    private $groupName;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user", referencedColumnName="username")
     */
    private $user;

    /**
     * @Column(name="activity", type="integer", length=4)
     */
    private $activity;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($value)
    {
        $this->date = $value;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($value)
    {
        $this->body = $value;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($value)
    {
        $this->groupName = $value;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($value)
    {
        $this->user = $value;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function setActivity($value)
    {
        $this->activity = $value;
    }

    /**
     * ToString of the entire object.
     *
     * @return object as string
     */
    public function __toString()
    {
        return "id: '" . $this->getId() . "' " .
               "date: '" . $this->getDate()->format('Y-m-d H:i:s') . "' " .
               "activity: '" . $this->getActivity() . "' " .
               "groupname: '" . $this->getGroupName() . "' " .
               "body: '" . $this->getBody() . "' ";
    }

    /**
     * ToSerializedObject of the entire object.
     *
     * @return object as serialized object.
     */
    public function toSerializedObject()
    {
        return get_object_vars($this);
    }
}
