<?php

namespace HGR\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __construct() {
        
        $this->products = new ArrayCollection();
    }
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="HGR\EntityBundle\Entity\Product", mappedBy="category")
     */
    private $products;
    

    /**
     * @var string
     *
     * @ORM\Column(name="imageURL", nullable=true,type="string", length=255)
     */
    private $imageURL;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    

    /**
     * Set imageURL
     *
     * @param string $imageURL
     * @return Category
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;
    
        
    }

    /**
     * Get imageURL
     *
     * @return string 
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }
    public function __toString() {
        return $this->getName();
    }
}
