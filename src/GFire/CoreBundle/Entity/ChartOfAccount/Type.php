<?php

namespace GFire\CoreBundle\Entity\ChartOfAccount;

use Doctrine\ORM\Mapping as ORM;
use GFire\CoreBundle\Entity\ChartOfAccount\Interfaces\TypeInterface;

/**
 * Type
 */
class Type implements  TypeInterface
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
    private $title;

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
     * @return Type
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
     * Set title
     *
     * @param string $title
     * @return Type
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Type
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
     * @return Type
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
     * @return Type
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
     * @return Type
     */
    public function setUpdatedAt($updatedAt)
    {
       // $this->updatedAt = $updatedAt;

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
    private $chartOfAccounts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chartOfAccounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chartOfAccounts
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccounts
     * @return Type
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
        return $this->id ? $this->getTitle() : '';
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $validations;

    /**
     * Add validations
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Validation $validations
     * @return Type
     */
    public function addValidation(\GFire\CoreBundle\Entity\ChartOfAccount\Validation $validations)
    {
        $this->validations[] = $validations;

        return $this;
    }

    /**
     * Remove validations
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Validation $validations
     */
    public function removeValidation(\GFire\CoreBundle\Entity\ChartOfAccount\Validation $validations)
    {
        $this->validations->removeElement($validations);
    }

    /**
     * Get validations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValidations()
    {
        return $this->validations;
    }
}
