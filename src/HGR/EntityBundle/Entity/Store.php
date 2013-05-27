<?php

namespace HGR\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Store
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Store
{
    
    
    public function __construct($name) {
        $this->name = $name;
        $this->stocks =  new ArrayCollection();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="HGR\EntityBundle\Entity\StockProduct",cascade={"persist","remove"})
     * @ORM\JoinTable(name="StoreStock",joinColumns={@ORM\JoinColumn(name="store_id",referencedColumnName="id")})
     */
    private $stocks;
    
    /**
     * @ORM\Column(name="addresseLine1",nullable=true, type="string", length=255)
     * @var String 
     */
    private $addresseLine1;
     /**
     * @ORM\Column(name="addresseLine2",nullable=true, type="string", length=255)
     * @var String 
     */
    private $addresseLine2;
     /**
     * @ORM\Column(name="postalCode",nullable=true, type="string", length=15)
     * @var String 
     */
    private $postalCode;
     /**
     * @ORM\Column(name="city",nullable=true, type="string", length=100)
     * @var String 
     */
    private $city;
     /**
     * @ORM\Column(name="country",nullable=true, type="string", length=100)
     * @var String 
     */
    private $country;
    
    public function addStocks($stock){
        $this->stocks[]= $stock;
    }
    public function getStocks(){
        return $this->stocks;
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
     * Set name
     *
     * @param string $name
     * @return Store
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
}
