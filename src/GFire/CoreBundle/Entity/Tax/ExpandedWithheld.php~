<?php

namespace GFire\CoreBundle\Entity\Tax;

use Doctrine\ORM\Mapping as ORM;
use GFire\CoreBundle\Entity\Interfaces\FinalTaxWithheldInterface;

/**
 * ExpandedWithheld
 */
class ExpandedWithheld implements  FinalTaxWithheldInterface
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
    private $natureOfIncomePayment;

    /**
     * @var string
     */
    private $ratePercentage;

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
     * @return ExpandedWithheld
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
     * Set natureOfIncomePayment
     *
     * @param string $natureOfIncomePayment
     * @return ExpandedWithheld
     */
    public function setNatureOfIncomePayment($natureOfIncomePayment)
    {
        $this->natureOfIncomePayment = $natureOfIncomePayment;

        return $this;
    }

    /**
     * Get natureOfIncomePayment
     *
     * @return string 
     */
    public function getNatureOfIncomePayment()
    {
        return $this->natureOfIncomePayment;
    }

    /**
     * Set ratePercentage
     *
     * @param string $ratePercentage
     * @return ExpandedWithheld
     */
    public function setRatePercentage($ratePercentage)
    {
        $this->ratePercentage = $ratePercentage;

        return $this;
    }

    /**
     * Get ratePercentage
     *
     * @return string 
     */
    public function getRatePercentage()
    {
        return $this->ratePercentage;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ExpandedWithheld
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
     * @return ExpandedWithheld
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
    private $generalLibraries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->generalLibraries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add generalLibraries
     *
     * @param \GFire\CoreBundle\Entity\GeneralLibrary $generalLibraries
     * @return ExpandedWithheld
     */
    public function addGeneralLibrary(\GFire\CoreBundle\Entity\GeneralLibrary $generalLibraries)
    {
        $this->generalLibraries[] = $generalLibraries;

        return $this;
    }

    /**
     * Remove generalLibraries
     *
     * @param \GFire\CoreBundle\Entity\GeneralLibrary $generalLibraries
     */
    public function removeGeneralLibrary(\GFire\CoreBundle\Entity\GeneralLibrary $generalLibraries)
    {
        $this->generalLibraries->removeElement($generalLibraries);
    }

    /**
     * Get generalLibraries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGeneralLibraries()
    {
        return $this->generalLibraries;
    }
    /**
     * @var string
     */
    private $title;


    /**
     * Set title
     *
     * @param string $title
     * @return ExpandedWithheld
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

    public function __toString(){
        return $this->id ? $this->getTitle() : '';
    }
}
