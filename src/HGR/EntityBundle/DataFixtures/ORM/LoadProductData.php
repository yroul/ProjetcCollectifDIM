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
use HGR\UserBundle\Entity\User;
class LoadProductData implements FixtureInterface
{
    /**
     * Load product fixtures
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        //create a ctagory
        $category = new Category();
        $category->setName("Bieres");
        
        //create somme product and add category to each
        $product1 = new Product();
        $product1->setName("Bière d'alpage");
        $product1->setPrice(4.5);
        $product1->setCategory($category);
        $product1->setBrand("Mon Alpage");
        $product1->setTags("biere,alpage,bon");
        $product2 = new Product();
        $product2->setName("La Dexter");
        $product2->setPrice(8.99);
        $product2->setCategory($category);
        $product2->setBrand("ACME Company");
        $product2->setTags("tag,tag2");
        $product3 = new Product();
        $product3->setName("Duff");
        $product3->setPrice(2.6);
        $product3->addMark(new Mark(4.5));
        $product3->setCategory($category);
        $product3->setBrand("Duff Corp");
        $product3->setTags("tag,tag2");
        $product4 = new Product();
        $product4->setName("Bières des trolls");
        $product4->setCategory($category);
        $product4->setBrand("BelgiumSAS");
        $product4->setPrice(10);
        //persist product (and category)
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        $manager->persist($product4);
        
        
        //user
        //$userManager = $this->get('fos_user.user_manager');
        $user = new User();
        $user->setPlainPassword("password");
        $user->setUsername("admin");
        $user->setRoles(array("ROLE_ADMIN"));
        $user->setEnabled(true);
        $user->setEmail("admin@example.com");
        //create store
       /* $store1 = new Store();
        $store1->setName("Magasin Annecy");
        $store2 = new Store();
        $store2->setName("Magasin Lyon");
        //create stock product
        $stockStore1 = new StockProduct();
        //add 15 product1 to this stock
        $stockStore1->setProduct($product1);
        $stockStore1->setAmount(15);      
        $store1->addStocks($stockStore1);
        $manager->persist($store1);*/
        $manager->persist($user);
        $manager->flush();
    }    
}