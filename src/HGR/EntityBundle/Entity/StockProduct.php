<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StockProduct
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class StockProduct
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
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

   /**
    *@ORM\OneToOne(targetEntity="HGR\EntityBundle\Entity\Product",cascade={"persist"})
    *@ORM\JoinColumn(name="product_id",referencedColumnName="id")
    *  
    */
    private $product;

     
    /**
     * Set amount
     *
     * @param integer $amount
     * @return Stock
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this->amount;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }
    public function setProduct($product){
        $this->product = $product;
    }
    public function getProduct(){
        return $this->product;
    }
}