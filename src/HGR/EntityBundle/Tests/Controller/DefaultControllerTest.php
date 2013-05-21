<?php

namespace HGR\EntityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use HGR\EntityBundle\Entity\Product as Product;
use HGR\EntityBundle\Entity\StockProduct as StockProduct;
use \InvalidArgumentException as InvalidArgumentException;
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
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
    
}
