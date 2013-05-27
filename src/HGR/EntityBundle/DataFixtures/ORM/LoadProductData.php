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
class LoadUserData implements FixtureInterface
{
    /**
     * Load product fixtures
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        //create a ctagory
        $category = new Category("Test_categorie1");
        
        //create somme product and add category to each
        $product1 = new Product("Test_produit1", 15.5);
        $product1->setCategory($category);
        $product2 = new Product("Test_produit2", 8.99);
        $product2->setCategory($category);
        $product3 = new Product("Test_produit3", 0.5);
        $product3->addMark(new Mark(4.5));
        $product3->setCategory($category);
        //persist product (and category)
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        
        //create store
        $store1 = new Store("Magasin1");
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