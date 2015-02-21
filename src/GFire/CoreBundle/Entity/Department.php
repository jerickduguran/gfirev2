<?php

namespace GFire\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\CoreBundle\Entity\Interfaces\DepartmentInterface;
/**
 * Department
 */
class Department implements DepartmentInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

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
     * Set title
     *
     * @param string $title
     * @return Department
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
     * Set code
     *
     * @param string $code
     * @return Department
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
     * Set description
     *
     * @param string $description
     * @return Department
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Department
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
     * @return Department
     */
    public function setUpdatedAt($updatedAt)
    {
     //   $this->updatedAt = $updatedAt;

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
    private $invoiceAccountEntries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoiceAccountEntries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invoiceAccountEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries
     * @return Department
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
}
