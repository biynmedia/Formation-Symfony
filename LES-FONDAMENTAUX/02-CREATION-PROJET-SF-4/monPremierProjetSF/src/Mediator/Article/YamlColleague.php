<?php

namespace App\Mediator\Article;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Service\Article\YamlProvider;
use Doctrine\Common\Collections\ArrayCollection;

class YamlColleague extends ArticleAbstractColleague
{

    private $yamlProvider;
    private $articles;

    /**
     * YamlColleague constructor.
     * @param $yamlProvider
     */
    public function __construct(YamlProvider $yamlProvider)
    {
        $this->yamlProvider = $yamlProvider;
        $this->articles = $yamlProvider->getArticles();
    }

    private function articleFactory($tmp) {

        # Création de mon Objet Catégorie
        $categorie = new Categorie();
        $categorie->setId($tmp->categorie['idcategorie']);
        $categorie->setLibelle($tmp->categorie['libellecategorie']);

        # Création de l'Auteur
        $auteur =  new Auteur();
        $auteur->setId($tmp->auteur['idauteur']);
        $auteur->setPrenom($tmp->auteur['prenomauteur']);
        $auteur->setNom($tmp->auteur['nomauteur']);
        $auteur->setEmail($tmp->auteur['emailauteur']);

        # On creér un objet Article
        $article = new Article();
        $article->setId($tmp->idarticle);
        $article->setTitre($tmp->titrearticle);
        $article->setContenu($tmp->contenuarticle);
        $article->setFeaturedimage($tmp->featuredimagearticle);
        $article->setAuteur($auteur);
        $article->setCategorie($categorie);
        $article->setSpotlight($tmp->spotlightarticle);
        $article->setSpecial($tmp->specialarticle);

        return $article;
    }

    /**
     * Finds an object by its primary key / identifier.
     * @param mixed $id The identifier.
     * @return Article|null The object.
     */
    public function find($id): ?Article
    {
        # Récupération de l'Article dans le tableau
        $key = array_search($id, array_column($this->articles, 'idarticle'));

        if(!$key) {
            return null;
        }

        # Ici, je récupère l'article de mon provider, cependant il n'a pas le meme format que ma BDD
        $tmp = (object) $this->articles['article' . ++$key];

        # Access Article as Object
        return $this->articleFactory($tmp);
    }

    /**
     * @return mixed
     */
    public function findAll(): array
    {
        $articles = [];

        foreach ($this->articles as $article) {
            $tmp = (object) $article;
            $articles[] = $this->articleFactory($tmp);
        }

        return $articles;
    }

    public function findLastFiveArticles(): iterable
    {
        return $this->generateArticleResult(array_slice($this->articles, -5));
    }

    public function generateArticleResult($articlesToHandle) {

        $articles = [];

        foreach ($articlesToHandle as $article) {
            $tmp = (object) $article;
            $articles[] = $this->articleFactory($tmp);
        }

        return $articles;
    }

    public function count(): int
    {
        return count($this->articles);
    }
}