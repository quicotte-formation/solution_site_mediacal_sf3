<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMiseAJour", type="datetime")
     */
    private $dateMiseAJour;
    
    /**
     * @ORM\JoinColumn(name="categorie_id")
     * @ORM\ManyToOne(targetEntity="Categorie",inversedBy="produits")
     */
    private $categorie;
    
    /**
     * @ORM\ManyToMany(targetEntity="Symptome", inversedBy="produits")
     * @ORM\JoinTable(name="produit_symptome")
     */
    private $symptomes;
    
    /**
     * @ORM\ManyToMany(targetEntity="Recette", mappedBy="produits")
     */
    private $recettes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="posologie", type="string", length=255)
     */
    private $posologie;


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
     * @return Produit
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
     * Set description
     *
     * @param string $description
     *
     * @return Produit
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
     * Set dateMiseAJour
     *
     * @param \DateTime $dateMiseAJour
     *
     * @return Produit
     */
    public function setDateMiseAJour($dateMiseAJour)
    {
        $this->dateMiseAJour = $dateMiseAJour;

        return $this;
    }

    /**
     * Get dateMiseAJour
     *
     * @return \DateTime
     */
    public function getDateMiseAJour()
    {
        return $this->dateMiseAJour;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->symptomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add symptome
     *
     * @param \AppBundle\Entity\Symptome $symptome
     *
     * @return Produit
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
     * Add recette
     *
     * @param \AppBundle\Entity\Recette $recette
     *
     * @return Produit
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

    /**
     * Set posologie
     *
     * @param string $posologie
     *
     * @return Produit
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
    
    public function __toString() {
        return $this->nom;
    }
}
