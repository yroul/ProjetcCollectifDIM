<?php

namespace HGR\RestBundle\Controller;
 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HGR\EntityBundle\Entity\Product;
use HGR\EntityBundle\Entity\Mark;
class ApiController extends RestController {

    public $data = "";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @Route("/rest")
     */
    public function testAction(){ 
        $product = new Product("Biere1", 15);
        $product->addMark(new Mark(5));
        $result = array();
        $result["result"] = true;
        $result["content"] = $product;
       if(is_array($result)){
           $this->response($this->json($result), 200);
       }else{
           $this->response('',404);
       }
    }
    
    /**
     * @Route("/user_mobile_incription")
     */
    public function user_mobile_incription()
    {
        return  $this->response($this->json(array("result"=>true)), 200);
    }
    
     /**
     * @Route("/user_mobile_connect")
     */
    public function user_mobile_connect()
    {
        return  $this->response($this->json(array("result"=>true)), 200);
    }
    
    /**
     * @Route("/product_mobile_list")
     */
    public function product_mobile_list()
    {
        
        return  $this->response($this->json(array("result"=>true, 
                                                  "products"=>array(array("id"      => 1,
                                                                    "name"    => "biere1",
                                                                    "couleur" => "blonde"),
                                                                    array("id"      => 2,
                                                                    "name"    => "biere2",
                                                                    "couleur" => "brune"),
                                                                    ))), 200);
    }
}

?>

