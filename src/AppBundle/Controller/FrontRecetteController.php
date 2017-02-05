<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontRecetteController extends Controller
{
    /**
     * @Route("/ajout_recette", name="ajout_recette")
     */
    public function ajoutAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        // Lie DTO et Form, et lance form-binding 2 sens
        $dto = new \AppBundle\Entity\Recette();
        $form = $this->createForm( \AppBundle\Form\RecetteType::class, $dto );
        $form->remove("date")->remove("etat")->remove("posologie")
                ->add("submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
        $form->handleRequest($req);
        
        if( $form->isSubmitted() && $form->isValid() ){
            
            // Le form vient d'être envoyé et est valide
            
            $dto->setDate( new \DateTime() );
            $dto->setEtat("NON_PUBLIE");
            $dto->setPosologie("***");
            // Persistance
            $em = $this->getDoctrine()->getManager();
            $em->persist( $dto );
            $em->flush();
            
            //return $this->render("AppBundle:FrontRecette:ajout_ok.html.twig");
            
            return $this->redirectToRoute("recette_index");
        }
        
        return $this->render('AppBundle:FrontRecette:ajout.html.twig', array(
            "monForm"=>$form->createView()
        ));
    }

}
