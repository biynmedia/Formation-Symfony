<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRepository")
 */
class Auteur
{

    // ---------------------- Propriétés

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateinscription;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $derniereconnexion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="auteur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $articles;

    // ---------------------- Constructor

    public function __construct() {

        # Quelques valeurs par défaut
        $this->dateinscription = new \DateTime();
        $this->articles = new ArrayCollection();
    }

    // ---------------------- Getters & Setters

}
