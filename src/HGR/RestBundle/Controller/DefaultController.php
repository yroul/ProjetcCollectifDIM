<?php

namespace HGR\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class DefaultController extends Controller
{
    /**
     * @Route("/rest")
     * @Template()
     * @QueryParam(name="count", requirements="\d+", strict=true, nullable=true, description="Item count limit")
     * @QueryParam(name="page", requirements="\d+", default="1", description="Page of the overview.")
     */
    public function getUserAction(ParamFetcher $paramFetcher)
    {
        $page = $paramFetcher->get('page');
       /* $view = View::create();
        $data = new \stdClass();
        $data->name ="clem";
        $view->setData($data);
        return $view;*/
         $articles = array('bim', 'bam', 'bingo');
         return array('articles' => $articles, 'page' => $page);
    }
}
