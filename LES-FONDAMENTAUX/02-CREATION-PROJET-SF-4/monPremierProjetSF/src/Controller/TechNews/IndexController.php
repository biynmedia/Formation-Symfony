<?php

namespace App\Controller\TechNews;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * Page d'accueil de notre site
     * Configuration de notre route grâce dans routes.yaml
     */
    public function index() {
        return $this->render('index/index.html.twig');
    }

    /**
     * Page permettant d'afficher les articles d'une catégorie
     * @Route("/{libellecategorie}",
     *     name="index_categorie",
     *     methods={"GET"},
     *     requirements={"libellecategorie"="\w+"})
     * @param $libellecategorie
     * @return Response
     */
    public function categorie($libellecategorie = 'tout') {
        return $this->render('index/categorie.html.twig');
    }

    /**
     * Page permettant d'afficher un article
     * @see https://symfony.com/doc/current/routing.html#adding-wildcard-requirements
     * @Route("/{libellecategorie}/{slugarticle}_{idarticle}.html", name="index_article",
     *     requirements={"idarticle"="\d+"} )
     */
    public function article($libellecategorie, $slugarticle, $idarticle) {
        # index.php/business/une-formation-symfony-a-paris_98426852.html
        return $this->render('index/article.html.twig');
    }
}