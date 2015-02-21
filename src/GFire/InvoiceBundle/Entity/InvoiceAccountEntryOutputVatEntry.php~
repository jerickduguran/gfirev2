<?php

namespace GFire\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceAccountEntryOutputVatEntryInterface;

/**
 * InvoiceAccountEntryOutputVatEntry
 */
class InvoiceAccountEntryOutputVatEntry implements InvoiceAccountEntryOutputVatEntryInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $grossPurchase;

    /**
     * @var string
     */
    private $vatReceived;

    /**
     * @var string
     */
    private $netSales;

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
     * Set grossPurchase
     *
     * @param string $grossPurchase
     * @return InvoiceAccountEntryOutputVatEntry
     */
    public function setGrossPurchase($grossPurchase)
    {
        $this->grossPurchase = $grossPurchase;

        return $this;
    }

    /**
     * Get grossPurchase
     *
     * @return string 
     */
    public function getGrossPurchase()
    {
        return $this->grossPurchase;
    }

    /**
     * Set vatReceived
     *
     * @param string $vatReceived
     * @return InvoiceAccountEntryOutputVatEntry
     */
    public function setVatReceived($vatReceived)
    {
        $this->vatReceived = $vatReceived;

        return $this;
    }

    /**
     * Get vatReceived
     *
     * @return string 
     */
    public function getVatReceived()
    {
        return $this->vatReceived;
    }

    /**
     * Set netSales
     *
     * @param string $netSales
     * @return InvoiceAccountEntryOutputVatEntry
     */
    public function setNetSales($netSales)
    {
        $this->netSales = $netSales;

        return $this;
    }

    /**
     * Get netSales
     *
     * @return string 
     */
    public function getNetSales()
    {
        return $this->netSales;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InvoiceAccountEntryOutputVatEntry
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
     * @return InvoiceAccountEntryOutputVatEntry
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
     * @var \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat
     */
    private $invoiceAccountEntryOutputVat;


    /**
     * Set invoiceAccountEntryOutputVat
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVat
     * @return InvoiceAccountEntryOutputVatEntry
     */
    public function setInvoiceAccountEntryOutputVat(\GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat $invoiceAccountEntryOutputVat = null)
    {
        $this->invoiceAccountEntryOutputVat = $invoiceAccountEntryOutputVat;

        return $this;
    }

    /**
     * Get invoiceAccountEntryOutputVat
     *
     * @return \GFire\InvoiceBundle\Entity\InvoiceAccountEntryOutputVat 
     */
    public function getInvoiceAccountEntryOutputVat()
    {
        return $this->invoiceAccountEntryOutputVat;
    }
}
