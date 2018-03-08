<?php

namespace App\Mediator\Article;

abstract class ArticleAbstractColleague implements ArticleRepositoryInterface
{
    protected $mediator;

    /**
     * @param mixed $mediator
     */
    public function setMediator(ArticleMediator $mediator)
    {
        $this->mediator = $mediator;
    }

}
