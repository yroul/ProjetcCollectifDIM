<?php

namespace HGR\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HGR\EntityBundle\Entity\StockProduct;
use HGR\EntityBundle\Form\StockProductType;
use HGR\EntityBundle\Form\StockProductEditType;
use \InvalidArgumentException;
/**
 * StockProduct controller.
 *
 * @Route("/stockproduct")
 */
class StockProductController extends Controller
{
    /**
     * Lists all StockProduct entities.
     *
     * @Route("/", name="stockproduct")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HGREntityBundle:StockProduct')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new StockProduct entity.
     *
     * @Route("/", name="stockproduct_create")
     * @Method("POST")
     * @Template("HGREntityBundle:StockProduct:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $stockProduct  = new StockProduct();
        $form = $this->createForm(new StockProductType(), $stockProduct);
        $form->bind($request);

        if ($form->isValid()) {
            try{
                $this->checkExistingStock($stockProduct->getProduct(), $stockProduct->getStore());
                $em = $this->getDoctrine()->getManager();
                $em->persist($stockProduct);
                $em->flush();
                return $this->redirect($this->generateUrl('stockproduct_show', array('id' => $stockProduct->getId())));
            }catch(InvalidArgumentException $e){
                $this->get('session')->setFlash('error',$e->getMessage());
                return $this->redirect($this->generateUrl('stockproduct_new'));
            }
            
            
        }

        return array(
            'entity' => $stockProduct,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new StockProduct entity.
     *
     * @Route("/new", name="stockproduct_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new StockProduct();
        $form   = $this->createForm(new StockProductType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a StockProduct entity.
     *
     * @Route("/{id}", name="stockproduct_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:StockProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockProduct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing StockProduct entity.
     *
     * @Route("/{id}/edit", name="stockproduct_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:StockProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockProduct entity.');
        }

        $editForm = $this->createForm(new StockProductEditType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing StockProduct entity.
     *
     * @Route("/{id}", name="stockproduct_update")
     * @Method("PUT")
     * @Template("HGREntityBundle:StockProduct:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:StockProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StockProduct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StockProductEditType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stockproduct_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a StockProduct entity.
     *
     * @Route("/{id}", name="stockproduct_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HGREntityBundle:StockProduct')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StockProduct entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stockproduct'));
    }

    /**
     * Creates a form to delete a StockProduct entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    /**
     * Check if a stock already exist between ths product and this store
     * @param type $product
     * @param type $store
     */
    private function checkExistingStock($product,$store){
       //TODO
        $storeRepo = $this->getDoctrine()->getManager()->getRepository("HGREntityBundle:Store");
        $store = $storeRepo->findOneBy(array('name'=>$store->getName()));
        //a store with this name already exist
        if($store != null){
            $stocks = $store->getStocks();
            foreach ($stocks as $stock) {
               $existingProductInStore = $stock->getProduct();
               //if the new product in store already exist
               if($existingProductInStore === $product){
                   throw new InvalidArgumentException("A stock already exist for the product '".$product->getName()."' in store '".$store->getName()."'.");
                   break;
               }
            }
        }
               
        
        
    }
}
