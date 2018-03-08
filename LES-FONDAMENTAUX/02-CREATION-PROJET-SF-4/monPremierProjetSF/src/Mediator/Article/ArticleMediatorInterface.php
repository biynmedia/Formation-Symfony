<?php

namespace App\Mediator\Article;

/**
 * Interface ArticleMediatorInterface est un contrat avec le médiateur?
 * Ce n'est pas obligatoire, mais reste une bonne pratique.
 * Grâce à Object Repository, on garde la même structure que doctrine.
 * @package App\Mediator
 */
interface ArticleMediatorInterface extends ArticleRepositoryInterface
{

    public function addSource(ArticleAbstractColleague $source): void;
    public function setSources(iterable $sources): void;
    public function getSources();

}