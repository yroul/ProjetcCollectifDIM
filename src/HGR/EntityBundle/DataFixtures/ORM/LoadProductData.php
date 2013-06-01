<?php
namespace HGR\EntityBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use HGR\EntityBundle\Entity\Product;
use HGR\EntityBundle\Entity\Category;
use HGR\EntityBundle\Entity\Store;
use HGR\EntityBundle\Entity\StockProduct;
use HGR\EntityBundle\Entity\Mark;
use HGR\EntityBundle\Entity\Comment;
class LoadProductData implements FixtureInterface
{
    /**
     * Load product fixtures
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        //create a ctagory
        $category = new Category();
        $category->setName("Test_categorie1");
        
        //create somme product and add category to each
        $product1 = new Product();
        $product1->setName("Test_produit1");
        $product1->setPrice(15.5);
        $product1->setCategory($category);
        $product1->setBrand("marque1");
        $product1->setTags("tag,tag2");
        $product2 = new Product();
        $product2->setName("Test_produit2");
        $product2->setPrice(8.99);
        $product2->setCategory($category);
        $product2->setBrand("marque1");
        $product2->setTags("tag,tag2");
        $product3 = new Product();
        $product3->setName("Test_produit3");
        $product3->setPrice(0.5);
        $product3->addMark(new Mark(4.5));
        $product3->setCategory($category);
        $product3->setBrand("marque1");
        $product3->setTags("tag,tag2");
        //persist product (and category)
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        
        //create store
        $store1 = new Store();
        $store1->setName("magasin1");
        //create stock product
        $stockStore1 = new StockProduct();
        //add 15 product1 to this stock
        $stockStore1->setProduct($product1);
        $stockStore1->setAmount(15);
        $store1->addStocks($stockStore1);
        $manager->persist($store1);
        
        $manager->flush();
    }    
}