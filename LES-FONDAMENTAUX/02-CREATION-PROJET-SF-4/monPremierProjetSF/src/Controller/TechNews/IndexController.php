<?php

namespace App\Controller\TechNews;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Exception\DuplicateColleagueDataException;
use App\Mediator\Article\ArticleMediator;
use App\Service\Article\YamlProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * Page d'accueil de notre site
     * Configuration de notre route grâce dans routes.yaml
     * @param YamlProvider $articleProvider
     * @param ArticleMediator $articleMediator
     * @return Response
     */
    public function index(YamlProvider $articleProvider, ArticleMediator $articleMediator) {

        # Récupération des Articles depuis ArticleProvider
        #$yamlArticles = $articleProvider->getArticles();
        $yamlArticles = $articleMediator->find(15);
//        $yamlArticles = $articleMediator->findAll();
        #$yamlArticles = $articleMediator->findLastFiveArticles();

        # Récupération des articles depuis la BDD
        $articles = $this->getDoctrine()->getRepository(Article::class)
            ->findAll();

        # Récupération des articles du spotlight
        $spotlight = $this->getDoctrine()->getRepository(Article::class)
            ->findSpotlightArticles();

        # Transmission à la vue
        return $this->render('index/index.html.twig', [
            'articles' => $articles,
            'yamlArticles' => $yamlArticles,
            'spotlight' => $spotlight
        ]);
    }

    /**
     * Page permettant d'afficher les articles d'une catégorie
     * @Route("/{_locale}/categorie/{libellecategorie}",
     *     name="index_categorie",
     *     methods={"GET"},
     *     requirements={"libellecategorie"="\w+"})
     * @param $libellecategorie
     * @return Response
     */
    public function categorie($libellecategorie = 'tout') {

        $categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findOneBy(
                ['libelle' => $libellecategorie]
            );

        $articles = $categorie->getArticles();

        return $this->render('index/categorie.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Page permettant d'afficher un article
     * @see https://symfony.com/doc/current/routing.html#adding-wildcard-requirements
     * @Route("/{_locale}/{libellecategorie}/{slugarticle}_{id}.html", name="index_article",
     *     requirements={"idarticle"="\d+"} )
     * @param $id
     * @param ArticleMediator $mediator
     * @return Response
     */
    public function article($id, ArticleMediator $mediator) {
        # https://symfony.com/doc/current/doctrine.html#automatically-fetching-objects-paramconverter
        # index.php/business/une-formation-symfony-a-paris_2.html

        try{
            $article = $mediator->find($id);
        } catch (DuplicateColleagueDataException $e) {

        }

        # Récupération avec Doctrine
        # $article = $this->getDoctrine()
        #     ->getRepository(Article::class)
        #     ->find($idarticle);

        # Si aucun article n'est trouvé...
        #if (!$article) {
            # On génère une exception
            # throw $this->createNotFoundException(
            #     'Nous n\'avons pas trouvé votre article ID : '.$idarticle
            # );
            # Ou on peut aussi rediriger l'utilisateur sur la page index.
        #    return $this->redirectToRoute('index',[],Response::HTTP_MOVED_PERMANENTLY);
        #}

        # Récupération des suggestions
        $suggestions = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticleSuggestions($article->getId(),$article->getCategorie()->getId());

        /**
         * Lazy Loading et le Chargement des Related Objects
         * Il est important de comprendre que nous avons accès à l'objet catégorie du produit,
         * de façon AUTOMATIQUE ! Cependant, les données de la catégorie ne sont récupéré
         * par doctrine que lorsque nous en faisant la demande, et pas avant ! Ceci pour alléger
         * le chargement de votre page.
         */
        # $categorie = $article->getCategorie()->getLibelle();

        return $this->render('index/article.html.twig', [
            'article' => $article,
            'suggestions' => $suggestions,
            #   'categorie' => $categorie
        ]);
    }

    public function sidebar(ArticleMediator $mediator) {

        # Récupération du Répository
        $repository = $this->getDoctrine()->getRepository(Article::class);

        # Récupération des 5 derniers articles
        $articles   = $mediator->findLastFiveArticles();

        # Récupération des articles à la position "special"
        $special    = $repository->findSpecialArticles();

        return $this->render('components/_sidebar.html.twig', [
            'articles'  => $articles,
            'special'   => $special
        ]);

    }

}
