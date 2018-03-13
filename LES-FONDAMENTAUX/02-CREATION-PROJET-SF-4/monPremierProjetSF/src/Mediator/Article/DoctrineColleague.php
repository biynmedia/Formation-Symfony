<?php

namespace App\Mediator\Article;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineColleague extends ArticleAbstractColleague
{

    private $em;
    private $entity = Article::class;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return Article|null The object.
     */
    public function find($id): ?Article
    {
        return $this->em
            ->getRepository($this->entity)
            ->find($id);
    }

    /**
     * @return mixed
     */
    public function findAll(): array
    {
        return $this->em
            ->getRepository($this->entity)
            ->findAll();
    }

    public function findLastFiveArticles(): iterable
    {
        return $this->em
            ->getRepository($this->entity)
            ->findLastFiveArticle();
    }

    public function count(): int
    {
        return $this->em
            ->getRepository($this->entity)
            ->findArticlesNumber();
    }
}
