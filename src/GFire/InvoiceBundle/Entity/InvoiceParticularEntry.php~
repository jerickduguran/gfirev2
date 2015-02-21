<?php

namespace GFire\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceParticularEntryInterface;

/**
 * InvoiceParticularEntry
 */
class InvoiceParticularEntry implements InvoiceParticularEntryInterface
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
    private $amount;

    /**
     * @var string
     */
    private $vatApplication;

    /**
     * @var string
     */
    private $total;

    /**
     * @var \DateTime
     */
    private $craetedAt;

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
     * @return InvoiceParticularEntry
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
     * Set amount
     *
     * @param string $amount
     * @return InvoiceParticularEntry
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set vatApplication
     *
     * @param string $vatApplication
     * @return InvoiceParticularEntry
     */
    public function setVatApplication($vatApplication)
    {
        $this->vatApplication = $vatApplication;

        return $this;
    }

    /**
     * Get vatApplication
     *
     * @return string 
     */
    public function getVatApplication()
    {
        return $this->vatApplication;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return InvoiceParticularEntry
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set craetedAt
     *
     * @param \DateTime $craetedAt
     * @return InvoiceParticularEntry
     */
    public function setCraetedAt($craetedAt)
    {
       // $this->craetedAt = $craetedAt;

        return $this;
    }

    /**
     * Get craetedAt
     *
     * @return \DateTime 
     */
    public function getCraetedAt()
    {
        return $this->craetedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return InvoiceParticularEntry
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
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \GFire\CoreBundle\Entity\Tax\FinalWithheld
     */
    private $taxFinalWithheld;

    /**
     * @var \GFire\CoreBundle\Entity\Tax\ExpandedWithheld
     */
    private $taxExpandedWithheld;

    /**
     * @var \GFire\InvoiceBundle\Entity\Invoice
     */
    private $invoice;


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InvoiceParticularEntry
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set taxFinalWithheld
     *
     * @param \GFire\CoreBundle\Entity\Tax\FinalWithheld $taxFinalWithheld
     * @return InvoiceParticularEntry
     */
    public function setTaxFinalWithheld(\GFire\CoreBundle\Entity\Tax\FinalWithheld $taxFinalWithheld = null)
    {
        $this->taxFinalWithheld = $taxFinalWithheld;

        return $this;
    }

    /**
     * Get taxFinalWithheld
     *
     * @return \GFire\CoreBundle\Entity\Tax\FinalWithheld 
     */
    public function getTaxFinalWithheld()
    {
        return $this->taxFinalWithheld;
    }

    /**
     * Set taxExpandedWithheld
     *
     * @param \GFire\CoreBundle\Entity\Tax\ExpandedWithheld $taxExpandedWithheld
     * @return InvoiceParticularEntry
     */
    public function setTaxExpandedWithheld(\GFire\CoreBundle\Entity\Tax\ExpandedWithheld $taxExpandedWithheld = null)
    {
        $this->taxExpandedWithheld = $taxExpandedWithheld;

        return $this;
    }

    /**
     * Get taxExpandedWithheld
     *
     * @return \GFire\CoreBundle\Entity\Tax\ExpandedWithheld 
     */
    public function getTaxExpandedWithheld()
    {
        return $this->taxExpandedWithheld;
    }

    /**
     * Set invoice
     *
     * @param \GFire\InvoiceBundle\Entity\Invoice $invoice
     * @return InvoiceParticularEntry
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

    public function __toString()
    {
        return $this->getId() ? $this->getTitle() : '';
    }
}
