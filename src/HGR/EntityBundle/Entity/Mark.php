<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mark
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mark
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="Value", type="float")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="HGR\EntityBundle\Entity\Product",inversedBy="marks")    
     * @var type Product
     */
    private $product;
    
    public function setProduct($product){
        $this->product = $product;
    }
    public function getProduct(){
        return $this->product;
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
     * Set value
     *
     * @param float $value
     * @return Mark
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }
}
