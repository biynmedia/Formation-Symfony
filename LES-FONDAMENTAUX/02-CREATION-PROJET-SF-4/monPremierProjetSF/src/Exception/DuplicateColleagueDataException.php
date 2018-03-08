<?php

namespace App\Exception;


use Doctrine\Common\Collections\ArrayCollection;
use Throwable;

class DuplicateColleagueDataException extends \RuntimeException
{

    private $articles;

    public function __construct(ArrayCollection $articles, string $message = "", Throwable $previous = null)
    {
        $this->articles = $articles;
        parent::__construct($message, 0, $previous);
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles(): ArrayCollection
    {
        return $this->articles;
    }

}