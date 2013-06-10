<?php

namespace HGR\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\Range(
     *      min = 0,
     *      max = 99999,
     *      minMessage = "La quantité doit être supérieur ou égale à 0",
     *      maxMessage = "La quantité doit être inférieur à 99999"
     * )
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

   /**
    * @Assert\NotBlank()
    *@ORM\OneToOne(targetEntity="HGR\EntityBundle\Entity\Product",cascade={"persist"},inversedBy="stocks")
    *@ORM\JoinColumn(name="product_id",referencedColumnName="id",onDelete="CASCADE")
    *  
    */
    private $product;

    /**
     * @Assert\NotBlank()
     *  @ORM\ManyToOne(targetEntity="HGR\EntityBundle\Entity\Store",inversedBy="stocks")
     *  
     */
    private $store;
     
    /**
     * Set amount
     *
     * @param integer $amount
     * @return Stock
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
    public function getId(){
        return $this->id;
    }
    public function getStore() {
        return $this->store;
    }

    public function setStore($store) {
        $this->store = $store;
    }

}
