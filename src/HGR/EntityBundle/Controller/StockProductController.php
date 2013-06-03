<?php

namespace HGR\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HGR\EntityBundle\Entity\StockProduct;
use HGR\EntityBundle\Form\StockProductType;

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
        $entity  = new StockProduct();
        $form = $this->createForm(new StockProductType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stockproduct_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
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

        $editForm = $this->createForm(new StockProductType(), $entity);
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
        $editForm = $this->createForm(new StockProductType(), $entity);
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
}
