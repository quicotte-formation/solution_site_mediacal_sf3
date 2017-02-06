<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FiltreController extends Controller
{
    /**
     * @Route("/filtre")
     */
    public function filtreAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        $dto = new \AppBundle\DTO\FiltreDTO();
        $form = $this->createForm(\AppBundle\Form\FiltreType::class, $dto);
        $form->handleRequest( $req );
        
        $qb = new \Doctrine\ORM\QueryBuilder( $this->getDoctrine()->getManager() );
        $qb->select("r")->from("AppBundle:Recette", "r")->orderBy("r.date", "DESC");
        
        if( $form->isSubmitted() ){
            // Contruction requete
            
            if( $dto->getUtilisateur()!=null )
                $qb->join ("r.utilisateur", "u")->andWhere ("u=:utilisateur")
                    ->setParameter("utilisateur", $dto->getUtilisateur ());
            
            if( sizeof( $dto->getProduits() )>=1 )
                $qb->join("r.produits", "p")->andWhere ("p IN (:produits)")
                    ->setParameter ("produits", $dto->getProduits ());
            
            if( sizeof( $dto->getSymptomes())>=1 )
                $qb->join ("r.symptomes", "s")->andWhere ("s IN (:mesSymptomes)")
                    ->setParameter ("mesSymptomes", $dto->getSymptomes ());
        }
        
        // Exécute requete
        $recettes = $qb->getQuery()->getResult();
        
        return $this->render('AppBundle:Filtre:filtre.html.twig', array(
            
            "monForm"=>$form->createView(),
            "recettes"=>$recettes
        ));
    }

}
