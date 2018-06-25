<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Utilisateur controller.
 *
 * @Route("utilisateurs")
 */
class UtilisateursController extends Controller
{
    /**
     * Lists all utilisateur entities.
     *
     * @Route("/", name="utilisateurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('GestionBundle:Utilisateurs')->findAll();

        return $this->render('utilisateurs/index.html.twig', array(
            'utilisateurs' => $utilisateurs,
        ));
    }

    /**
     * Creates a new utilisateur entity.
     *
     * @Route("/new", name="utilisateurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm('GestionBundle\Form\utilisateursType', $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateurs);
            $em->flush();

            return $this->redirectToRoute('utilisateurs_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateurs/new.html.twig', array(
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a utilisateur entity.
     *
     * @Route("/{id}", name="utilisateurs_show")
     * @Method("GET")
     */
    public function showAction(utilisateurs $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);

        return $this->render('utilisateurs/show.html.twig', array(
            'utilisateur' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing utilisateur entity.
     *
     * @Route("/{id}/edit", name="utilisateurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, utilisateurs $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $editForm = $this->createForm('GestionBundle\Form\utilisateursType', $utilisateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateurs_edit', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateurs/edit.html.twig', array(
            'utilisateur' => $utilisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a utilisateur entity.
     *
     * @Route("/{id}", name="utilisateurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, utilisateurs $utilisateur)
    {
        $form = $this->createDeleteForm($utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateurs_index');
    }

    /**
     * Creates a form to delete a utilisateur entity.
     *
     * @param utilisateurs $utilisateur The utilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(utilisateurs $utilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateurs_delete', array('id' => $utilisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
