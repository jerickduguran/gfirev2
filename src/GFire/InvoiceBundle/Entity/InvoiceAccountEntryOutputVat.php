<?php

namespace GFire\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceAccountEntryOutputVatInterface;

/**
 * InvoiceAccountEntryOutputVat
 */
class InvoiceAccountEntryOutputVat implements InvoiceAccountEntryOutputVatInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $transactionDate;

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
     * Set transactionDate
     *
     * @param \DateTime $transactionDate
     * @return InvoiceAccountEntryOutputVat
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * Get transactionDate
     *
     * @return \DateTime 
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InvoiceAccountEntryOutputVat
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
     * @return InvoiceAccountEntryOutputVat
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
     * @var \GFire\CoreBundle\Entity\ChartOfAccount
     */
    private $chartOfAccount;

    /**
     * @var \GFire\InvoiceBundle\Entity\InvoiceAccountEntry
     */
    private $invoiceAccountEntry;


    /**
     * Set chartOfAccount
     *
     * @param \GFire\CoreBundle\Entity\ChartOfAccount $chartOfAccount
     * @return InvoiceAccountEntryOutputVat
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
     * Set invoiceAccountEntry
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntry
     * @return InvoiceAccountEntryOutputVat
     */
    public function setInvoiceAccountEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntry = null)
    {
        $this->invoiceAccountEntry = $invoiceAccountEntry;

        return $this;
    }

    /**
     * Get invoiceAccountEntry
     *
     * @return \GFire\InvoiceBundle\Entity\InvoiceAccountEntry 
     */
    public function getInvoiceAccountEntry()
    {
        return $this->invoiceAccountEntry;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceAccountEntryOutputVatEntries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoiceAccountEntryOutputVatEntries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invoiceAccountEntryOutputVatEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVatEntry $invoiceAccountEntryOutputVatEntries
     * @return InvoiceAccountEntryOutputVat
     */
    public function addInvoiceAccountEntryOutputVatEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVatEntry $invoiceAccountEntryOutputVatEntries)
    {
        $this->invoiceAccountEntryOutputVatEntries[] = $invoiceAccountEntryOutputVatEntries;

        return $this;
    }

    /**
     * Remove invoiceAccountEntryOutputVatEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVatEntry $invoiceAccountEntryOutputVatEntries
     */
    public function removeInvoiceAccountEntryOutputVatEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVatEntry $invoiceAccountEntryOutputVatEntries)
    {
        $this->invoiceAccountEntryOutputVatEntries->removeElement($invoiceAccountEntryOutputVatEntries);
    }

    /**
     * Get invoiceAccountEntryOutputVatEntries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceAccountEntryOutputVatEntries()
    {
        return $this->invoiceAccountEntryOutputVatEntries;
    }
}
