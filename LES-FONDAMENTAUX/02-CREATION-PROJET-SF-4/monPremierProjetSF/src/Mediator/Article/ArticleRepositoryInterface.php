<?php

namespace App\Mediator\Article;


use App\Entity\Article;

interface ArticleRepositoryInterface
{

    public function find($id): ?Article;
    public function findAll();
    public function findLastFiveArticles(): iterable;
    public function count(): int;

    #public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
    #public function findOneBy(array $criteria);
}
