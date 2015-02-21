<?php

namespace GFire\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\CoreBundle\Entity\Interfaces\ChartOfAccountInterface;

/**
 * ChartOfAccount
 */
class ChartOfAccount implements ChartOfAccountInterface
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
     * @return ChartOfAccount
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
     * @return ChartOfAccount
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
     * @return ChartOfAccount
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
     * @return ChartOfAccount
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
     * @return ChartOfAccount
     */
    public function setCreatedAt($createdAt)
    {
      //  $this->createdAt = $createdAt;

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
     * @return ChartOfAccount
     */
    public function setUpdatedAt($updatedAt)
    {
      //  $this->updatedAt = $updatedAt;

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

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PostPersist
     */
    public function postPersist()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @var \GFire\CoreBundle\Entity\ChartOfAccount\Type
     */
    private $type;


    /**
     * Set type
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Type $type
     * @return ChartOfAccount
     */
    public function setType(\GFire\CoreBundle\Entity\ChartOfAccount\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \GFire\CoreBundle\Entity\ChartOfAccount\Type 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var \GFire\CoreBundle\Entity\ChartOfAccount\Group
     */
    private $group;


    /**
     * Set group
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Group $group
     * @return ChartOfAccount
     */
    public function setGroup(\GFire\CoreBundle\Entity\ChartOfAccount\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \GFire\CoreBundle\Entity\ChartOfAccount\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $validations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->validations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add validations
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount\Validation $validations
     * @return ChartOfAccount
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceAccountEntries;


    /**
     * Add invoiceAccountEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries
     * @return ChartOfAccount
     */
    public function addInvoiceAccountEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries)
    {
        $this->invoiceAccountEntries[] = $invoiceAccountEntries;

        return $this;
    }

    /**
     * Remove invoiceAccountEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries
     */
    public function removeInvoiceAccountEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries)
    {
        $this->invoiceAccountEntries->removeElement($invoiceAccountEntries);
    }

    /**
     * Get invoiceAccountEntries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceAccountEntries()
    {
        return $this->invoiceAccountEntries;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceAccountEntryOutputVat;


    /**
     * Add invoiceAccountEntryOutputVat
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntryOutputVat
     * @return ChartOfAccount
     */
    public function addInvoiceAccountEntryOutputVat(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntryOutputVat)
    {
        $this->invoiceAccountEntryOutputVat[] = $invoiceAccountEntryOutputVat;

        return $this;
    }

    /**
     * Remove invoiceAccountEntryOutputVat
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntryOutputVat
     */
    public function removeInvoiceAccountEntryOutputVat(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntryOutputVat)
    {
        $this->invoiceAccountEntryOutputVat->removeElement($invoiceAccountEntryOutputVat);
    }

    /**
     * Get invoiceAccountEntryOutputVat
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceAccountEntryOutputVat()
    {
        return $this->invoiceAccountEntryOutputVat;
    }

    public function __toString()
    {
        return $this->id ? $this->getCode() . " - " . $this->getTitle() : '';
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceAccountEntryOutputVats;


    /**
     * Get invoiceAccountEntryOutputVats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceAccountEntryOutputVats()
    {
        return $this->invoiceAccountEntryOutputVats;
    }
}
