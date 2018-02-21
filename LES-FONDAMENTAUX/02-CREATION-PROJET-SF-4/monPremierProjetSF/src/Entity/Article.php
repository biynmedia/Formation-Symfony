<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{

    // ---------------------- Propriétés

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $featuredimage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $special;

    /**
     * @ORM\Column(type="boolean")
     */
    private $spotlight;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Auteur", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    // ---------------------- Constructor

    public function __construct()
    {
        $this->datecreation = new \DateTime();
    }

    // ---------------------- Getters & Setters

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getFeaturedimage()
    {
        return $this->featuredimage;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @param mixed $featuredimage
     */
    public function setFeaturedimage($featuredimage)
    {
        $this->featuredimage = $featuredimage;
    }

    /**
     * @return mixed
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * @param mixed $special
     */
    public function setSpecial($special)
    {
        $this->special = $special;
    }

    /**
     * @return mixed
     */
    public function getSpotlight()
    {
        return $this->spotlight;
    }

    /**
     * @param mixed $spotlight
     */
    public function setSpotlight($spotlight)
    {
        $this->spotlight = $spotlight;
    }

    /**
     * @return mixed
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param mixed $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    }
}
