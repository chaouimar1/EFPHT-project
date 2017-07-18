<?php

namespace PFE\DashBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PFE\DashBundle\Entity\Adherent;
use PFE\DashBundle\Form\AdherentType;

/**
 * Adherent controller.
 *
 */
class AdherentController extends Controller
{

    /**
     * Lists all Adherent entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $req = $request->request;

        $y = $req->get('actionyear');
        $m = $req->get('actionmonth');

        $entities = $em->getRepository('PFEDashBundle:Adherent')->findByDate($y,$m);

        return $this->render('PFEDashBundle:Adherent:index.html.twig', array(
            'currt' => 'Adherent',
            'entities' => $entities,
            'm' => $m, 'y' => $y,
        ));
    }
    /**
     * Creates a new Adherent entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Adherent();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('add', 'Nouveau Adhérent ajouté !');

            return $this->redirect($this->generateUrl('pfe_saisi_adherent', array('id' => $entity->getId())));
        }

        return $this->render('PFEDashBundle:Adherent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Adherent entity.
     *
     * @param Adherent $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Adherent $entity)
    {
        $form = $this->createForm(new AdherentType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_adherent_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-av-playlist-add left"></i> Enregistrer'));

        return $form;
    }

    /**
     * Displays a form to create a new Adherent entity.
     *
     */
    public function newAction()
    {
        $entity = new Adherent();
        $form   = $this->createCreateForm($entity);

        return $this->render('PFEDashBundle:Adherent:new.html.twig', array(
            'currt' => 'Adherent',
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adherent entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PFEDashBundle:Adherent:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Adherent entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('PFEDashBundle:Adherent:edit.html.twig', array(
            'currt' => 'Adherent',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Adherent entity.
    *
    * @param Adherent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Adherent $entity)
    {
        $form = $this->createForm(new AdherentType(), $entity, array(
            'action' => $this->generateUrl('pfe_saisi_adherent_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => '<i class="mdi-action-cached left"></i> Mettre à jour'));

        return $form;
    }
    /**
     * Edits an existing Adherent entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PFEDashBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('update', 'Informations actualisées !');

            return $this->redirect($this->generateUrl('pfe_saisi_adherent_edit', array('id' => $id)));
        }

        return $this->render('PFEDashBundle:Adherent:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Adherent entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PFEDashBundle:Adherent')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Adherent entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('delete', 'Adhérent supprimé.');
        }

        return $this->redirect($this->generateUrl('pfe_saisi_adherent'));
    }

    /**
     * Creates a form to delete a Adherent entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_saisi_adherent_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => '<i class="mdi-action-delete left"></i> Supprimer',
                                                        'attr'=>array('class'=>'red')))
            ->getForm()
        ;
    }
}
