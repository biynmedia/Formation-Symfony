<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRepository")
 * @UniqueEntity(fields={"email"}, errorPath="email", message="Ce compte existe déjà !")
 * @see https://symfony.com/doc/current/reference/constraints/UniqueEntity.html
 */
class Auteur implements UserInterface
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getDateinscription()
    {
        return $this->dateinscription;
    }

    /**
     * @param \DateTime $dateinscription
     */
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles[] = $roles;
    }

    /**
     * @return mixed
     */
    public function getDerniereconnexion()
    {
        return $this->derniereconnexion;
    }

    /**
     * @param string $timestamp
     */
    public function setDerniereconnexion($timestamp = 'now')
    {
        date_default_timezone_set('Europe/Paris');
        $this->derniereconnexion = new \DateTime($timestamp);
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return null;
    }
}
