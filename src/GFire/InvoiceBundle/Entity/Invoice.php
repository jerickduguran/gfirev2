<?php

namespace GFire\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceInterface;

/**
 * Invoice
 */
class Invoice implements InvoiceInterface
{
    const STATUS_UNPAID         = 'UNPAID';
    const STATUS_PARTIALLY_PAID = 'PARTIALLY_PAID';
    const STATUS_FULLY_PAID     = 'FULLY_PAID';
    const STATUS_DUE            = 'DUE';
    const STATUS_OVERDUE        = 'OVERDUE ';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $invoiceNumber;

    /**
     * @var string
     */
    private $purchaseOrderNumber;

    /**
     * @var \DateTime
     */
    private $dateReceived;

    /**
     * @var \DateTime
     */
    private $invoiceDate;

    /**
     * @var \DateTime
     */
    private $period;

    /**
     * @var \DateTime
     */
    private $dueDate;

    /**
     * @var string
     */
    private $headerMessage;

    /**
     * @var string
     */
    private $footerMessage;

    /**
     * @var integer
     */
    private $termsOfPaymentDays;

    /**
     * @var string
     */
    private $totalAmount;

    /**
     * @var string
     */
    private $status;

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
     * Set invoiceNumber
     *
     * @param string $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return string 
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set purchaseOrderNumber
     *
     * @param string $purchaseOrderNumber
     * @return Invoice
     */
    public function setPurchaseOrderNumber($purchaseOrderNumber)
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;

        return $this;
    }

    /**
     * Get purchaseOrderNumber
     *
     * @return string 
     */
    public function getPurchaseOrderNumber()
    {
        return $this->purchaseOrderNumber;
    }

    /**
     * Set dateReceived
     *
     * @param \DateTime $dateReceived
     * @return Invoice
     */
    public function setDateReceived($dateReceived)
    {
        $this->dateReceived = $dateReceived;

        return $this;
    }

    /**
     * Get dateReceived
     *
     * @return \DateTime 
     */
    public function getDateReceived()
    {
        return $this->dateReceived;
    }

    /**
     * Set invoiceDate
     *
     * @param \DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * Get invoiceDate
     *
     * @return \DateTime 
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set period
     *
     * @param \DateTime $period
     * @return Invoice
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return \DateTime 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Invoice
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set headerMessage
     *
     * @param string $headerMessage
     * @return Invoice
     */
    public function setHeaderMessage($headerMessage)
    {
        $this->headerMessage = $headerMessage;

        return $this;
    }

    /**
     * Get headerMessage
     *
     * @return string 
     */
    public function getHeaderMessage()
    {
        return $this->headerMessage;
    }

    /**
     * Set footerMessage
     *
     * @param string $footerMessage
     * @return Invoice
     */
    public function setFooterMessage($footerMessage)
    {
        $this->footerMessage = $footerMessage;

        return $this;
    }

    /**
     * Get footerMessage
     *
     * @return string 
     */
    public function getFooterMessage()
    {
        return $this->footerMessage;
    }

    /**
     * Set termsOfPaymentDays
     *
     * @param integer $termsOfPaymentDays
     * @return Invoice
     */
    public function setTermsOfPaymentDays($termsOfPaymentDays)
    {
        $this->termsOfPaymentDays = $termsOfPaymentDays;

        return $this;
    }

    /**
     * Get termsOfPaymentDays
     *
     * @return integer 
     */
    public function getTermsOfPaymentDays()
    {
        return $this->termsOfPaymentDays;
    }

    /**
     * Set totalAmount
     *
     * @param string $totalAmount
     * @return Invoice
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return string 
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Invoice
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Invoice
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
     * @return Invoice
     */
    public function setUpdatedAt($updatedAt)
    {
        ///$this->updatedAt = $updatedAt;

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
     * @var \GFire\CoreBundle\Entity\Book
     */
    private $book;


    /**
     * Set book
     *
     * @param \GFire\CoreBundle\Entity\Book $book
     * @return Invoice
     */
    public function setBook(\GFire\CoreBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \GFire\CoreBundle\Entity\Book 
     */
    public function getBook()
    {
        return $this->book;
    }
    /**
     * @var \GFire\CoreBundle\Entity\GeneralLibrary
     */
    private $generalLibrary;


    /**
     * Set generalLibrary
     *
     * @param \GFire\CoreBundle\Entity\GeneralLibrary $generalLibrary
     * @return Invoice
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
     * @var \GFire\CoreBundle\Entity\Currency
     */
    private $currency;

    /**
     * @var \GFire\CoreBundle\Entity\TermsOfPayment
     */
    private $termsOfPayment;


    /**
     * Set currency
     *
     * @param \GFire\CoreBundle\Entity\Currency $currency
     * @return Invoice
     */
    public function setCurrency(\GFire\CoreBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \GFire\CoreBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set termsOfPayment
     *
     * @param \GFire\CoreBundle\Entity\TermsOfPayment $termsOfPayment
     * @return Invoice
     */
    public function setTermsOfPayment(\GFire\CoreBundle\Entity\TermsOfPayment $termsOfPayment = null)
    {
        $this->termsOfPayment = $termsOfPayment;

        return $this;
    }

    /**
     * Get termsOfPayment
     *
     * @return \GFire\CoreBundle\Entity\TermsOfPayment 
     */
    public function getTermsOfPayment()
    {
        return $this->termsOfPayment;
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
        $this->status                =   self::STATUS_UNPAID;
    }

    /**
     * Add invoiceAccountEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries
     * @return Invoice
     */
    public function addInvoiceAccountEntry(\GFire\InvoiceBundle\Entity\InvoiceAccountEntry $invoiceAccountEntries)
    {
        $invoiceAccountEntries->setInvoice($this);
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
    private $invoiceParticularEntries;


    /**
     * Add invoiceParticularEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceParticularEntry $invoiceParticularEntries
     * @return Invoice
     */
    public function addInvoiceParticularEntry(\GFire\InvoiceBundle\Entity\InvoiceParticularEntry $invoiceParticularEntries)
    {
        $invoiceParticularEntries->setInvoice($this);
        $this->invoiceParticularEntries[] = $invoiceParticularEntries;

        return $this;
    }

    /**
     * Remove invoiceParticularEntries
     *
     * @param \GFire\InvoiceBundle\Entity\InvoiceParticularEntry $invoiceParticularEntries
     */
    public function removeInvoiceParticularEntry(\GFire\InvoiceBundle\Entity\InvoiceParticularEntry $invoiceParticularEntries)
    {
        $this->invoiceParticularEntries->removeElement($invoiceParticularEntries);
    }

    /**
     * Get invoiceParticularEntries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoiceParticularEntries()
    {
        return $this->invoiceParticularEntries;
    }


    public function __toString()
    {
        return $this->getId() ? $this->getInvoiceNumber() : '';
    }

    public function getTotalAccountDebitCredit()
    {
        $total_debit  = 0;
        $total_credit = 0;
        $total        = 0;

        if($account_entries = $this->getInvoiceAccountEntries()){
            foreach($account_entries as $account_entry){
                $total_debit  = $account_entry->getDebit() + $total_debit;
                $total_credit = $account_entry->getCredit() + $total_credit;
            }
            }

        $total  = $total_debit - $total_credit;
        $totals = array('debit' => $total_debit,  'credit' => $total_credit, 'total' => $total);

        return   $totals;
    }


    protected $total_account_entry;
    public function setTotalAccountEntry($total_account_entry)
    {
        $this->total_account_entry = $total_account_entry;
        return $this;
    }
    public function getTotalAccountEntry()
    {
        return  $this->total_account_entry;
    }
}
