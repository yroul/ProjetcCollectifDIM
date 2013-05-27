<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
/**
 * Mark
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mark
{
    public function __construct($value) {
        $this->setValue($value);
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
        $step = 25;
        if($value >= 0 && $value <=5){
            
            $res = ($value*100) % $step;
            if( $res == 0){
               $this->value = $value; 
            }
            else{
                throw new InvalidArgumentException("Mark value must be a multiple of 0.25");
            }
            
        }
        else{
            throw new InvalidArgumentException("Mark value must be 0<= x <= 5");
        }
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
