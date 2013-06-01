<?php

namespace HGR\EntityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use HGR\EntityBundle\Entity\Product as Product;
use \InvalidArgumentException as InvalidArgumentException;
class DatabaseControllerTest extends WebTestCase
{
    public function setUp() {
        
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()
                             ->get('doctrine.orm.entity_manager');
        $this->repo = $kernel->getContainer()
                             ->get('doctrine.orm.entity_manager')
                             ->getRepository("HGREntityBundle:Product");
      
    }
    public function tearDown() {
        //on tearDownm, only delete product prefixed by "test_"
        //to avoid side effect on others stored objects
        parent::tearDown();
        $products = $this->repo->findAll();
        $em = $this->em;
        foreach ($products as $key => $value) {            
            if(substr($products[$key]->getName(),0,4) == "test")
                $em->remove($products[$key]);
        }
        $em->flush();
        
    }
    
    public function testProductCreateReadSimpleProduct(){
        
        $product = new Product();
        $product->setName("test_monProduit");
        $product->setPrice(15);
      //  $product->setTags("tag1,tag2");
        $em = $this->em;
        $em->persist($product);
        $em->flush();
        $productFetched = $this->repo->find($product->getId());
        $this->assertEquals($productFetched->getName(),"test_monProduit");
        
              
    }
    
}
