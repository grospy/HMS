<?php
/**
 * Chart tracker entity.
 *
 */

namespace OpenEMR\Entities;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;

/**
 * @Table(name="chart_tracker")
 * @Entity(repositoryClass="OpenEMR\Repositories\ChartTrackerRepository")
 */
class ChartTracker
{

    /**
     * Default constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Id
     * @Column(name="ct_pid"), type="int", length=11, nullable=false, options={"default" : 0})
     */
    private $pid;

    /**
     * @Column(name="ct_when", type="datetime", nullable=false)
     */
    private $when;

    /**
     * @Column(name="ct_userid"), type="bigint", length=20, nullable=false, options={"default" : 0})
     */
    private $userId;

    /**
     * @Column(name="ct_location"), type="varchar", length=31, nullable=false, options={"default" : "")
     */
    private $location;


    /**
     * Getter for pid.
     *
     * return pid
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Setter for pid.
     *
     * @param pid
     */
    public function setPid($value)
    {
        $this->pid = $value;
    }

    /**
     * Getter for when.
     *
     * return when datetime
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * Setter for when.
     *
     * @param when datetime
     */
    public function setWhen($value)
    {
        $this->when = $value;
    }

    /**
     * Getter for user id.
     *
     * return user id number
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter for user id.
     *
     * @param user id number
     */
    public function setUserId($value)
    {
        $this->userId = $value;
    }

    /**
     * Getter for location.
     *
     * return location string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Setter for location.
     *
     * @param location string
     */
    public function setLocation($value)
    {
        $this->location = $value;
    }

    /**
     * ToString of the entire object.
     *
     * @return object as string
     */
    public function __toString()
    {
        return "pid: '" . $this->getPid() . "' " .
               "date: '" . $this->getDate() . "' " .
               "userId: '" . $this->getUserId() . "' " .
               "location" . $this->getLocation() . "' " ;
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
