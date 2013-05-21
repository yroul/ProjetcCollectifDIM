<?php

namespace HGR\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Routing\ClassResourceInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'test');
    }
    
    /**
     * @Route("/json")
     * @Template()
     */
    public function jsonAction()
    {
        $data        = new StdClass();
        $data->name  = "clement";
        $data->email = "clemgrim@gmail.com";
        $serializer  = \JMS\SerializerBundle\SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($data, 'json');
        echo $jsonContent;
    }
}
