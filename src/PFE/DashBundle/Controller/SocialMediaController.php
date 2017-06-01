<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\SocialMedia;
use PFE\DashBundle\Form\SocialMediaType;

/**
 * SocialMedia controller.
 *
 */
class SocialMediaController extends Controller
{

    /**
     * Lists all SocialMedia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PFEDashBundle:SocialMedia')->findAll();

        return $this->render('PFEDashBundle:SocialMedia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SocialMedia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SocialMedia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('socialmedia_show', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:SocialMedia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SocialMedia entity.
     *
     * @param SocialMedia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SocialMedia $entity)
    {
        $form = $this->createForm(new SocialMediaType(), $entity, array(
            'action' => $this->generateUrl('socialmedia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new SocialMedia entity.
     *
     */
    public function newAction()
    {
        $entity = new SocialMedia();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:SocialMedia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SocialMedia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:SocialMedia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialMedia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:SocialMedia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SocialMedia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:SocialMedia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialMedia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:SocialMedia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SocialMedia entity.
    *
    * @param SocialMedia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SocialMedia $entity)
    {
        $form = $this->createForm(new SocialMediaType(), $entity, array(
            'action' => $this->generateUrl('socialmedia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing SocialMedia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:SocialMedia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialMedia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('socialmedia_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:SocialMedia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SocialMedia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:SocialMedia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SocialMedia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('socialmedia'));
    }

    /**
     * Creates a form to delete a SocialMedia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('socialmedia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit',  array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                            'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
