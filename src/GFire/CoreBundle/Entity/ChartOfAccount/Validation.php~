<?php

namespace GFire\CoreBundle\Entity\ChartOfAccount;

use Doctrine\ORM\Mapping as ORM;
use GFire\CoreBundle\Entity\ChartOfAccount\Interfaces\ValidationInterface;

/**
 * Validation
 */
class Validation implements ValidationInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Validation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Validation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Validation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Validation
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Validation
     */
    public function setCreatedAt($createdAt)
    {
       // $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Validation
     */
    public function setUpdatedAt($updatedAt)
    {
        //$this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }
    public function postPersist()
    {
        $this->updatedAt = new \DateTime();
    }
     
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $types;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $chartOfAccounts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chartOfAccounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add types
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Type $types
     * @return Validation
     */
    public function addType(\GFire\CoreBundle\Entity\ChartOfAccount\Type $types)
    {
        $types->addValidation($this);
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Type $types
     */
    public function removeType(\GFire\CoreBundle\Entity\ChartOfAccount\Type $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add chartOfAccounts
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccounts
     * @return Validation
     */
    public function addChartOfAccount(\GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccounts)
    {
        $this->chartOfAccounts[] = $chartOfAccounts;

        return $this;
    }

    /**
     * Remove chartOfAccounts
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccounts
     */
    public function removeChartOfAccount(\GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccounts)
    {
        $this->chartOfAccounts->removeElement($chartOfAccounts);
    }

    /**
     * Get chartOfAccounts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChartOfAccounts()
    {
        return $this->chartOfAccounts;
    }

    public function __toString()
    {
        return $this->id ? $this->getName() : '';
    }
}
