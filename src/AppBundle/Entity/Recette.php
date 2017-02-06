<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Callback;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetteRepository")
 * 
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="recettes")
     * @ORM\JoinColumn(name="utilisateur_id")
     */
    private $utilisateur;
    
    /**
     * @var string
     *
     * @NotBlank(message="Remplissez ce champ!")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @NotBlank(message="Remplissez ce champ!")
     * @Length(min=10, minMessage="Mini 10 caractères")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="posologie", type="string", length=255)
     */
    private $posologie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="qt_ingredients", type="string", length=255)
     */
    private $qt_ingredients;
    
    /**
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="recettes")
     * @ORM\JoinTable(name="recette_produit")
     */
    private $produits;
    
    /**
     * @ORM\ManyToMany(targetEntity="Symptome", inversedBy="recettes")
     * @ORM\JoinTable(name="recette_symptome")
     */
    private $symptomes;

    
    /**
     * @Callback
     * @param \Symfony\Component\Validator\Context\ExecutionContextInterface $context
     * @param type $payload
     */
    public function callbackNomEtDescDifferents(
            \Symfony\Component\Validator\Context\ExecutionContextInterface $context, 
            $payload){
        
        if( strcmp( $this->nom, $this->description)==0 )
                $context->buildViolation 
                        ("Le nom et desc doivent être différents")
                        ->addViolation ();
                
    }
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Recette
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Recette
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Recette
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Recette
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Recette
     */
    public function addProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\Produit $produit
     */
    public function removeProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Add symptome
     *
     * @param \AppBundle\Entity\Symptome $symptome
     *
     * @return Recette
     */
    public function addSymptome(\AppBundle\Entity\Symptome $symptome)
    {
        $this->symptomes[] = $symptome;

        return $this;
    }

    /**
     * Remove symptome
     *
     * @param \AppBundle\Entity\Symptome $symptome
     */
    public function removeSymptome(\AppBundle\Entity\Symptome $symptome)
    {
        $this->symptomes->removeElement($symptome);
    }

    /**
     * Get symptomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSymptomes()
    {
        return $this->symptomes;
    }

    /**
     * Set posologie
     *
     * @param string $posologie
     *
     * @return Recette
     */
    public function setPosologie($posologie)
    {
        $this->posologie = $posologie;

        return $this;
    }

    /**
     * Get posologie
     *
     * @return string
     */
    public function getPosologie()
    {
        return $this->posologie;
    }

    /**
     * Set qtIngredients
     *
     * @param string $qtIngredients
     *
     * @return Recette
     */
    public function setQtIngredients($qtIngredients)
    {
        $this->qt_ingredients = $qtIngredients;

        return $this;
    }

    /**
     * Get qtIngredients
     *
     * @return string
     */
    public function getQtIngredients()
    {
        return $this->qt_ingredients;
    }
    
    /**
     * Set Produits
     *
     * @param string $produits
     *
     * @return Recette
     */
    public function setProduits($produits)
    {
        $this->produits = $produits;

        return $this;
    }
    
    public function __toString() {
        return $this->nom;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Recette
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
