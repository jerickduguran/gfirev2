<?php

namespace GFire\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceAccountEntryInterface;

/**
 * InvoiceAccountEntry
 */
class InvoiceAccountEntry implements InvoiceAccountEntryInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dnReference;

    /**
     * @var string
     */
    private $debit;

    /**
     * @var string
     */
    private $credit;

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
     * Set dnReference
     *
     * @param string $dnReference
     * @return InvoiceAccountEntry
     */
    public function setDnReference($dnReference)
    {
        $this->dnReference = $dnReference;

        return $this;
    }

    /**
     * Get dnReference
     *
     * @return string 
     */
    public function getDnReference()
    {
        return $this->dnReference;
    }

    /**
     * Set debit
     *
     * @param string $debit
     * @return InvoiceAccountEntry
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Get debit
     *
     * @return string 
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Set credit
     *
     * @param string $credit
     * @return InvoiceAccountEntry
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return string 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InvoiceAccountEntry
     */
    public function setCreatedAt($createdAt)
    {
        //$this->createdAt = $createdAt;

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
     * @return InvoiceAccountEntry
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
     * @var \GFire\CoreBundle\Entity\ChartOfAccount
     */
    private $chartOfAccount;

    /**
     * @var \GFire\CoreBundle\Entity\GeneralLibrary
     */
    private $generalLibrary;

    /**
     * @var \GFire\CoreBundle\Entity\Project
     */
    private $project;

    /**
     * @var \GFire\CoreBundle\Entity\Department
     */
    private $department;

    /**
     * @var \GFire\InvoiceBundle\Entity\Invoice
     */
    private $invoice;


    /**
     * Set chartOfAccount
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccount
     * @return InvoiceAccountEntry
     */
    public function setChartOfAccount(\GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccount = null)
    {
        $this->chartOfAccount = $chartOfAccount;

        return $this;
    }

    /**
     * Get chartOfAccount
     *
     * @return \GFire\CoreBundle\Entity\ChartOfAccount 
     */
    public function getChartOfAccount()
    {
        return $this->chartOfAccount;
    }

    /**
     * Set generalLibrary
     *
     * @param \GFire\CoreBundle\Entity\GeneralLibrary $generalLibrary
     * @return InvoiceAccountEntry
     */
    public function setGeneralLibrary(\GFire\CoreBundle\Entity\GeneralLibrary $generalLibrary = null)
    {
        $this->generalLibrary = $generalLibrary;

        return $this;
    }

    /**
     * Get generalLibrary
     *
     * @return \GFire\CoreBundle\Entity\GeneralLibrary 
     */
    public function getGeneralLibrary()
    {
        return $this->generalLibrary;
    }

    /**
     * Set project
     *
     * @param \GFire\CoreBundle\Entity\Project $project
     * @return InvoiceAccountEntry
     */
    public function setProject(\GFire\CoreBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \GFire\CoreBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set department
     *
     * @param \GFire\CoreBundle\Entity\Department $department
     * @return InvoiceAccountEntry
     */
    public function setDepartment(\GFire\CoreBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \GFire\CoreBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set invoice
     *
     * @param \GFire\InvoiceBundle\Entity\Invoice $invoice
     * @return InvoiceAccountEntry
     */
    public function setInvoice(\GFire\InvoiceBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \GFire\InvoiceBundle\Entity\Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceAccountEntryOutputVats;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoiceAccountEntryOutputVats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invoiceAccountEntryOutputVats
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVats
     * @return InvoiceAccountEntry
     */
    public function addInvoiceAccountEntryOutputVat(\GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVats)
    {
        $this->invoiceAccountEntryOutputVats[] = $invoiceAccountEntryOutputVats;

        return $this;
    }

    /**
     * Remove invoiceAccountEntryOutputVats
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVats
     */
    public function removeInvoiceAccountEntryOutputVat(\GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVats)
    {
        $this->invoiceAccountEntryOutputVats->removeElement($invoiceAccountEntryOutputVats);
    }

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
