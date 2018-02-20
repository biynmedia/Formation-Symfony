<?php

namespace App\Controller\TechNews;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * Démonstration, Ajouter un Article avec Doctrine
     * @Route("/article", name="article")
     */
    public function index()
    {

        # Création de la catégorie
        $categorie = new Categorie();
        $categorie->setLibelle('Business');

        # Création de l'Auteur
        $auteur = new Auteur();
        $auteur->setPrenom('Hugo');
        $auteur->setNom('LIEGEARD');
        $auteur->setEmail('hugo@biyn.media');
        $auteur->setPassword('test');

        # Création de l'Article
        $article = new Article();
        $article->setTitre('Tip Aligning Digital Marketing with Business Goals and Objectives');
        $article->setContenu('<p><span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>');
        $article->setFeaturedimage('3.jpg');
        $article->setSpecial(0);
        $article->setSpotlight(1);

        # On associe une catégorie et un auteur à notre article
        $article->setCategorie($categorie);
        $article->setAuteur($auteur);

        # On sauvegarde le tout en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->persist($auteur);
        $em->persist($article);
        $em->flush();

        # Retour de la vue
        return new Response(
            'Nouvel article ajouté avec l\'id: '.$article->getId()
            .' et la nouvelle catégorie : '.$categorie->getLibelle().' de l\'Auteur '.$auteur->getPrenom()
        );
    }
}
