<?php

namespace App\Controller\TechNews;

use App\Controller\Helper;
use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    use Helper;

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
        # $em->flush();

        # Retour de la vue
        return new Response(
            'Nouvel article ajouté avec l\'id: '.$article->getId()
            .' et la nouvelle catégorie : '.$categorie->getLibelle().' de l\'Auteur '.$auteur->getPrenom()
        );
    }

    /**
     * Formulaire pour ajouter un article
     * @Security("has_role('ROLE_AUTEUR')")
     * @Route("/creer-un-article", name="article_add")
     */
    public function addarticle(Request $request) {

        # Récupération des catégories
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        # Création d'un nouvel article
        $article = new Article();

        # Récupération de l'Auteur
        # Normalement, on aurait récupéré l'auteur en session...
        $auteur = $this->getDoctrine()->getRepository(Auteur::class)->find(1);
        $article->setAuteur($auteur);

        # Créer un Formulaire permettant l'ajout d'un Article
        $form = $this->createForm(ArticleType::class, $article);
            /**
             * Maintenant que tous les champs ont été créés, nous allons
             * pouvoir récupérer le formulaire
             */

            # Traitement des données POST
            $form->handleRequest($request);

            # Vérification des données du Formulaire
            if ($form->isSubmitted() && $form->isValid()) :

                # Récupération des données
                $article = $form->getData();

                # Récupération de l'image
                $image      = $article->getFeaturedimage();

                # Nom du Fichier
                $fileName   = $this->slugify($article->getTitre().$image->guessExtension());
                $image->move(
                    $this->getParameter('articles_assets_directory'),
                    $fileName
                );

                # Mise à jour du nom de l'image
                $article->setFeaturedimage($fileName);

                # Insertion en BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                # Redirection sur l'Article qui vient d'être créé.
                return $this->redirectToRoute('index_article', [
                    'libellecategorie' => $this->slugify($article->getCategorie()->getLibelle()),
                    'slugarticle'      => $this->slugify($article->getTitre()),
                    'id'               => $article->getId()
                ]);

            endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('article/ajouterarticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
