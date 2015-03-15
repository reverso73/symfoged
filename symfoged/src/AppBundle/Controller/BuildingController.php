<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Building;
use AppBundle\Form\BuildingType;

/**
 * Building controller.
 *
 * @Route("/copropriete")
 */
class BuildingController extends Controller
{

    /**
     * Lists all Building entities.
     *
     * @Route("/", name="copropriete")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Building')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Building entity.
     *
     * @Route("/", name="copropriete_create")
     * @Method("POST")
     * @Template("AppBundle:Building:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Building();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('copropriete_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Building entity.
     *
     * @param Building $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Building $entity)
    {
        $form = $this->createForm(new BuildingType(), $entity, array(
            'action' => $this->generateUrl('copropriete_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Building entity.
     *
     * @Route("/new", name="copropriete_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Building();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Building entity.
     *
     * @Route("/{id}", name="copropriete_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Building')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Building entity.
     *
     * @Route("/{id}/edit", name="copropriete_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Building')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Building entity.
    *
    * @param Building $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Building $entity)
    {
        $form = $this->createForm(new BuildingType(), $entity, array(
            'action' => $this->generateUrl('copropriete_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Building entity.
     *
     * @Route("/{id}", name="copropriete_update")
     * @Method("PUT")
     * @Template("AppBundle:Building:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Building')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Building entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('copropriete_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Building entity.
     *
     * @Route("/{id}", name="copropriete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Building')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Building entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('copropriete'));
    }

    /**
     * Creates a form to delete a Building entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('copropriete_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
