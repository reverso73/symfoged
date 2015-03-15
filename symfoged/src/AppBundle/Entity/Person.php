<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastName;
    
    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    protected $isActive;
    
    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    protected $isInCS;
    
    /**
     * @ORM\OneToMany(targetEntity="Building", mappedBy="person")
     */
    protected $buildings;
    
    public function __construct()
    {
    	$this->buildings = new ArrayCollection();
    }

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
     * Set firstName
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Person
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add buildings
     *
     * @param \AppBundle\Entity\Building $buildings
     * @return Person
     */
    public function addBuilding(\AppBundle\Entity\Building $buildings)
    {
        $this->buildings[] = $buildings;

        return $this;
    }

    /**
     * Remove buildings
     *
     * @param \AppBundle\Entity\Building $buildings
     */
    public function removeBuilding(\AppBundle\Entity\Building $buildings)
    {
        $this->buildings->removeElement($buildings);
    }

    /**
     * Get buildings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBuildings()
    {
        return $this->buildings;
    }

    /**
     * Set isInCS
     *
     * @param boolean $isInCS
     * @return Person
     */
    public function setIsInCS($isInCS)
    {
        $this->isInCS = $isInCS;

        return $this;
    }

    /**
     * Get isInCS
     *
     * @return boolean 
     */
    public function getIsInCS()
    {
        return $this->isInCS;
    }
}
