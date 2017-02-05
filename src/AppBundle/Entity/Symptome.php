<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Symptome
 *
 * @ORM\Table(name="symptome")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SymptomeRepository")
 */
class Symptome
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="symptomes")
     */
    private $produits;
    
    /**
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="symptomes")
     */
    private $recettes;


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
     * @return Symptome
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
     * @return Symptome
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
     * Add recette
     *
     * @param \AppBundle\Entity\Recette $recette
     *
     * @return Symptome
     */
    public function addRecette(\AppBundle\Entity\Recette $recette)
    {
        $this->recettes[] = $recette;

        return $this;
    }

    /**
     * Remove recette
     *
     * @param \AppBundle\Entity\Recette $recette
     */
    public function removeRecette(\AppBundle\Entity\Recette $recette)
    {
        $this->recettes->removeElement($recette);
    }

    /**
     * Get recettes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecettes()
    {
        return $this->recettes;
    }
    
    public function __toString() {
        return $this->nom;
    }
}
