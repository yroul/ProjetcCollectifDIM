<?php

namespace HGR\EntityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use HGR\EntityBundle\Entity\Product as Product;
use HGR\EntityBundle\Entity\StockProduct as StockProduct;
use \InvalidArgumentException as InvalidArgumentException;
use HGR\EntityBundle\Entity\Mark;
class DefaultControllerTest extends WebTestCase
{
    
    public function testStockProductAmountUnderZero(){
        $stockProduct = new StockProduct();
        try{
            
            $stockProduct->setAmount(-15);
        }catch(InvalidArgumentException $expected){
            return;
        }
        
        $this->setExpectedException("InvalidArgumentException");
    }
    public function testAddStockProductAmount(){
         $stockProduct = new StockProduct();
         $stockProduct->setAmount(15);
         $this->assertEquals(15,$stockProduct->getAmount());
                 
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testMarValueToHight(){
        $mark = new Mark(45);
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testMarValueToLow(){
        $mark = new Mark(-0.5);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testMarValueBadStep(){
        $mark = new Mark(2.9);
    }
    public function testMarValueOk(){
        $mark = new Mark(2.5);
        $this->assertEquals($mark->getValue(),2.5);
    }
    
}
