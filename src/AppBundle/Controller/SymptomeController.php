<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Symptome;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Symptome controller.
 *
 * @Route("symptome")
 */
class SymptomeController extends Controller
{
    /**
     * Lists all symptome entities.
     *
     * @Route("/", name="symptome_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $symptomes = $em->getRepository('AppBundle:Symptome')->findAll();

        return $this->render('symptome/index.html.twig', array(
            'symptomes' => $symptomes,
        ));
    }

    /**
     * Creates a new symptome entity.
     *
     * @Route("/new", name="symptome_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $symptome = new Symptome();
        $form = $this->createForm('AppBundle\Form\SymptomeType', $symptome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($symptome);
            $em->flush($symptome);

            return $this->redirectToRoute('symptome_show', array('id' => $symptome->getId()));
        }

        return $this->render('symptome/new.html.twig', array(
            'symptome' => $symptome,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a symptome entity.
     *
     * @Route("/{id}", name="symptome_show")
     * @Method("GET")
     */
    public function showAction(Symptome $symptome)
    {
        $deleteForm = $this->createDeleteForm($symptome);

        return $this->render('symptome/show.html.twig', array(
            'symptome' => $symptome,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing symptome entity.
     *
     * @Route("/{id}/edit", name="symptome_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Symptome $symptome)
    {
        $deleteForm = $this->createDeleteForm($symptome);
        $editForm = $this->createForm('AppBundle\Form\SymptomeType', $symptome);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('symptome_edit', array('id' => $symptome->getId()));
        }

        return $this->render('symptome/edit.html.twig', array(
            'symptome' => $symptome,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a symptome entity.
     *
     * @Route("/{id}", name="symptome_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Symptome $symptome)
    {
        $form = $this->createDeleteForm($symptome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($symptome);
            $em->flush($symptome);
        }

        return $this->redirectToRoute('symptome_index');
    }

    /**
     * Creates a form to delete a symptome entity.
     *
     * @param Symptome $symptome The symptome entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Symptome $symptome)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('symptome_delete', array('id' => $symptome->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
