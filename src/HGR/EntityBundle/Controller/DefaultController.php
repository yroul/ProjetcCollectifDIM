<?php

namespace HGR\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/home/", name="home")
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => '');
    }
}
