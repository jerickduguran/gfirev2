<?php

namespace GFire\CoreBundle\Entity;

use GFire\CoreBundle\Entity\Interfaces\IndustryInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industry
 */
class Industry implements IndustryInterface
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
     * @return Industry
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
     * @return Industry
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
     * @return Industry
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
     * @return Industry
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
     * @return Industry
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
     * @return Industry
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

    public function __toString()
    {
        return $this->id ? $this->getTitle() : '';
    }
}
