<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontUtilisateurController extends Controller
{

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        $req->getSession()->invalidate();
        
        return $this->redirectToRoute("login");
    }
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        // Crée form sur base du dto
        $dto = new \AppBundle\DTO\InscriptionDTO();
        $form = $this->createForm(\AppBundle\Form\InscriptionType::class,$dto);
        $form->handleRequest($req);
        
        if( $form->isSubmitted() && $form->isValid()){
            
            // Le formulaire a été envoyé et valide
            
            // Inscription en DB et redirection
            $util = new \AppBundle\Entity\Utilisateur();
            $util->setLogin( $dto->getLogin() );
            $util->setEmail( $dto->getEmail() );
            $util->setMdp(  $dto->getMdp2());
            $util->setNom( $dto->getNom() );
            $util->setPrenom( $dto->getPrenom() );
            $util->setType( "NORMAL" );
            
            $this->getDoctrine()->getManager()->persist( $util );
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute("login");
        }
        
        // Le form n'a pas encore été submit OU est pas valide
        
        // Rendu du formulaire
        return $this->render("AppBundle:FrontUtilisateur:inscription.html.twig",
                array("monForm"=>$form->createView())
                );
    }

    
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $dto = new \AppBundle\DTO\InscriptionDTO();
        $form = $this->createForm(\AppBundle\Form\ConnexionType::class, $dto);
        $form->handleRequest($request);
        
        if( $form->isSubmitted() ){

            // Récup user en DB
            $rep = $this->getDoctrine()->getRepository("AppBundle:Utilisateur");
            $util = $rep->findOneBy( array("login"=>$dto->getLogin(), "mdp"=>$dto->getMdp1())  );
            
            // Si trouvé: place en session et redirection
            if( $util!=null ){
                
                $request->getSession()->set("utilConnecte", $util);
                return $this->redirectToRoute("login");
            }
            else{
                // Sinon supprime session
                $request->getSession()->invalidate();
                
                // Redirect même endroit
                
                return $this->redirectToRoute("login");
            }
            
            
        }
        
        return $this->render('AppBundle:FrontUtilisateur:login.html.twig', 
            array("monForm"=>$form->createView())
        );
    }

}
