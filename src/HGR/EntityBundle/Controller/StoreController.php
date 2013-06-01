<?php

namespace HGR\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HGR\EntityBundle\Entity\Store;
use HGR\EntityBundle\Form\StoreType;

/**
 * Store controller.
 *
 * @Route("/store")
 */
class StoreController extends Controller
{
    /**
     * Lists all Store entities.
     *
     * @Route("/", name="store")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HGREntityBundle:Store')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Store entity.
     *
     * @Route("/", name="store_create")
     * @Method("POST")
     * @Template("HGREntityBundle:Store:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Store();
        $form = $this->createForm(new StoreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('store_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Store entity.
     *
     * @Route("/new", name="store_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Store();
        $form   = $this->createForm(new StoreType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Store entity.
     *
     * @Route("/{id}", name="store_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     * @Route("/{id}/edit", name="store_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $editForm = $this->createForm(new StoreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Store entity.
     *
     * @Route("/{id}", name="store_update")
     * @Method("PUT")
     * @Template("HGREntityBundle:Store:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HGREntityBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StoreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('store_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Store entity.
     *
     * @Route("/{id}", name="store_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HGREntityBundle:Store')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Store entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('store'));
    }

    /**
     * Creates a form to delete a Store entity by id.
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
