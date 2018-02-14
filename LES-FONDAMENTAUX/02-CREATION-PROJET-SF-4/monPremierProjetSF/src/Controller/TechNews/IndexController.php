<?php

namespace App\Controller\TechNews;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * Page d'accueil de notre site
     * Configuration de notre route grâce dans routes.yaml
     * @return Response
     */
    public function index() {
        return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
    }

    /**
     * Page permettant d'afficher les articles d'une catégorie
     * @Route("/categorie/{libellecategorie}", name="index_categorie", methods={"GET"})
     * @param $libellecategorie
     * @return Response
     */
    public function categorie($libellecategorie = 'computing') {
        return new Response("<html><body><h1>PAGE CATEGORIE : $libellecategorie</h1></body></html>");
    }

    /**
     * Page permettant d'afficher un article
     * @see https://symfony.com/doc/current/routing.html#adding-wildcard-requirements
     * @Route("/{libellecategorie}/{slugarticle}_{idarticle}.html", name="index_article", requirements={"idarticle"="\d+"} )
     */
    public function article($libellecategorie, $slugarticle, $idarticle) {
        # index.php/business/une-formation-symfony-a-paris_98426852.html
        return new Response("<html><body><h1>PAGE ARTICLE : $libellecategorie | $slugarticle | $idarticle</h1></body></html>");
    }
}