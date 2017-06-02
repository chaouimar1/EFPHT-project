<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Fondoc;
use PFE\DashBundle\Form\FondocType;

/**
 * Fondoc controller.
 *
 */
class FondocController extends Controller
{

    /**
     * Lists all Fondoc entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PFEDashBundle:Fondoc')->findAll();

        return $this->render('PFEDashBundle:Fondoc:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Fondoc entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Fondoc();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fondoc_show', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Fondoc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Fondoc entity.
     *
     * @param Fondoc $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fondoc $entity)
    {
        $form = $this->createForm(new FondocType(), $entity, array(
            'action' => $this->generateUrl('fondoc_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Fondoc entity.
     *
     */
    public function newAction()
    {
        $entity = new Fondoc();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Fondoc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fondoc entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fondoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Fondoc:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fondoc entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fondoc entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Fondoc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Fondoc entity.
    *
    * @param Fondoc $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fondoc $entity)
    {
        $form = $this->createForm(new FondocType(), $entity, array(
            'action' => $this->generateUrl('fondoc_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Fondoc entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fondoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fondoc_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Fondoc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Fondoc entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Fondoc')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fondoc entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fondoc'));
    }

    /**
     * Creates a form to delete a Fondoc entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fondoc_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
