<?php

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscriptionDTO
 *
 * @author tom
 */
class InscriptionDTO {
    
    /**
     * @NotBlank
     * @var string
     */
    private $nom;

    /**
     * @NotBlank
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $mdp1;
    
    private $mdp2;

    /**
     * @Callback
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     * @param type $payload
     */
    public function callbackMdpEgaux(
            \Symfony\Component\Validator\Context\ExecutionContextInterface $context, 
            $payload){
        if( strcmp($this->mdp1, $this->mdp2)!=0 )
                $context->buildViolation ("Les mdp doivent être identiques")->addViolation ();
    }
    
    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getLogin() {
        return $this->login;
    }

    function getEmail() {
        return $this->email;
    }

    function getMdp1() {
        return $this->mdp1;
    }

    function getMdp2() {
        return $this->mdp2;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMdp1($mdp1) {
        $this->mdp1 = $mdp1;
    }

    function setMdp2($mdp2) {
        $this->mdp2 = $mdp2;
    }

}
