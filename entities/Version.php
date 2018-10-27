<?php
/**
 * Version entity.
 *
 */

namespace OpenEMR\Entities;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;

/**
 * @Table(name="version")
 * @Entity(repositoryClass="OpenEMR\Repositories\VersionRepository")
 */
class Version
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Column(name="v_major", type="integer", length=11, nullable=false, options={"default" : 0})
     */
    private $major;

    /**
     * @Column(name="v_minor", type="integer", length=11, nullable=false, options={"default" : 0}))
     */
    private $minor;

    /**
     * @Column(name="v_patch", type="integer", length=11, nullable=false, options={"default" : 0}))
     */
    private $patch;

    /**
     * @Column(name="v_realpatch", type="integer", length=11, nullable=false, options={"default" : 0}))
     */
    private $realPatch;

    /**
     * @Column(name="v_tag", type="string", length=31, nullable=false, options={"default" : ""}))
     */
    private $tag;

    /**
     * @Id
     * @Column(name="v_database", type="integer", length=11, nullable=false, options={"default" : 0}))
     */
    private $database;

    /**
     * @Column(name="v_acl", type="integer", length=11, nullable=false, options={"default" : 0}))
     */
    private $acl;

    /**
     * Getter for major.
     *
     * return major number
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * Setter for major.
     *
     * @param major number
     */
    public function setMajor($value)
    {
        $this->major = $value;
    }

    /**
     * Getter for minor.
     *
     * return minor number
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * Setter for minor.
     *
     * @param minor number
     */
    public function setMinor($value)
    {
        $this->minor = $value;
    }

    /**
     * Getter for patch.
     *
     * @return patch number
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * Setter for patch.
     *
     * @param patch number
     */
    public function setPatch($value)
    {
        $this->patch = $value;
    }

    /**
     * Getter for real patch.
     *
     * @return real patch number
     */
    public function getRealPatch()
    {
        return $this->realPatch;
    }

    /**
     * Setter for real patch.
     *
     * @param real patch number
     */
    public function setRealPatch($value)
    {
        $this->realPatch = $value;
    }

    /**
     * Getter for tag.
     *
     * @return tag string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Setter for tag.
     *
     * @param tag string
     */
    public function setTag($value)
    {
        $this->tag = $value;
    }

    /**
     * Getter for database.
     *
     * @return database number
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Setter for database.
     *
     * @param database number
     */
    public function setDatabase($value)
    {
        $this->database = $value;
    }

    /**
     * Getter for acl.
     *
     * @return acl number
     */
    public function getAcl()
    {
        return $this->acl;
    }

    /**
     * Setter for acl.
     *
     * @param acl number
     */
    public function setAcl($value)
    {
        $this->acl = $value;
    }

    /**
     * ToString of the entire object.
     *
     * @return object as string
     */
    public function __toString()
    {
        return "acl: '" . $this->getAcl() . "' " .
               "database: '" . $this->getDatabase() . "' " .
               "tag: '" . $this->getTag() . "' " .
               "realPatch: '" . $this->getRealPatch() . "' " .
               "patch: '" . $this->getPatch() . "' " .
               "minor: '" . $this->getMinor() . "' " .
               "major: '" . $this->getMajor() . "'";
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
