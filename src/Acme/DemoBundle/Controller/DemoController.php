<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Entity\Product as Product;
use Acme\DemoBundle\Entity\StockProduct as StockProduct;
use Acme\DemoBundle\Entity\Store as Store;
use Acme\DemoBundle\Entity\Mark as Mark;
class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/test",name="test")
     * @Template()
     */
    public function testEntitiesAction(){
    /*    $product = new Product();
        $product->setName("SODOMIE");
        
        $store = new Store();
        $store->setName("MAXIME");
        
        $stockProductStockPerso = new StockProduct();
        $stockProductStockPerso->setProduct($product);
        $stockProductStockPerso->setStore($store);
        $stockProductStockPerso->setAmount(4515);
        $store->addStocks($stockProductStockPerso);
        $em = $this->getDoctrine()->getManager();
        $em->persist($store);
        
        
        
        $em->flush();*/
        
      /*   
        $store = $this->getDoctrine()->getRepository("AcmeDemoBundle:Store")
                ->findOneBy(array("name"=>"MAXIME"));
        
       $stocks = $store->getStocks();
       $stock = $stocks[0];
       $em = $this->getDoctrine()->getManager();
       $em->remove($store);
       $em->flush();
        
        */
        $product = new Product();
        $product->setName("Dwillwork");
        $mark = new Mark();
        $mark->setValue("10");
        $mark2 = new Mark();
        $mark2->setValue("11");
        $product->addMarks($mark);
        $product->addMarks($mark2);
        $em = $this->getDoctrine()->getManager();
        
       /*$product = $this->getDoctrine()->getRepository("AcmeDemoBundle:Product")
               ->findOneBy(array("id"=>1));
       $product->addMarks($mark);
       $product->addMarks($mark2);
       
       $em = $this->getDoctrine()->getManager();*/
        $em->persist($product);
        $em->flush();
      
        return array("name"=>"dfg");
    }
    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $mailer = $this->get('mailer');
                // .. setup a message and send it
                // http://symfony.com/doc/current/cookbook/email.html

                $this->get('session')->getFlashBag()->set('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_demo'));
            }
        }

        return array('form' => $form->createView());
    }
}
