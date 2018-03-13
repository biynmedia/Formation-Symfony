<?php

namespace App\Mediator\Article;


use App\Entity\Article;
use App\Exception\DuplicateColleagueDataException;
use Doctrine\Common\Collections\ArrayCollection;

class ArticleMediator implements ArticleMediatorInterface
{
    private $sources;

    /**
     * Permet d'ajouter une source d'informations (Colleagues) au médiateur.
     * Les sources sont ajouté via Symfony...
     * Autrement dit, un provider de nos articles.
     * @param mixed $source
     */
    public function addSource(ArticleAbstractColleague $source): void
    {
        $this->sources[] = $source;
    }

    public function setSources(iterable $sources): void
    {
        $this->sources = $sources;
    }

    public function getSources()
    {
        return $this->sources;
    }

    private function iterateOverSources($functionToCall): ArrayCollection {

        $articles = [];

        /* @var $source ArticleAbstractColleague */
        /* @var $article Article */

        foreach ($this->sources as $source) :
            foreach ($source->$functionToCall() as $article) {
                if (!array_key_exists($article->getId(), $articles)) {
                    $articles[$article->getId()] = $article;
                }
            }
        endforeach;
        return new ArrayCollection($articles);

    }

    public function find($id): ?Article
    {
        $articles = [];

        # On parcours dynamiquement les sources
        /* @var $source ArticleAbstractColleague */
        foreach ($this->sources as $source) :
            if(null !== $source->find($id)) {
                $articles[] = $source->find($id);
            }
        endforeach;

//        dump($articles); die();
        # Throw error in dev mode... How to check symfony dev mode ?
        /*if(count($articles) > 1) :
            throw new DuplicateColleagueDataException(sprintf(
                'Return value of %s cannot return more than one record on line %s', get_class($this).'::'.__FUNCTION__.'()', __LINE__
            ));
        endif;*/

        # Retourne l'article de la dernière source
        return array_pop($articles);
    }

    public function findAll(): iterable {
        return $this->iterateOverSources('findAll');
    }

    public function findLastFiveArticles(): iterable
    {
        return array_reverse($this->iterateOverSources('findLastFiveArticles')->slice(-5));
    }

    public function count(): int
    {
        return count($this->sources);
    }
}