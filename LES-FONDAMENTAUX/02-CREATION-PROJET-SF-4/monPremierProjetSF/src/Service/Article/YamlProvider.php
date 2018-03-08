<?php

namespace App\Service\Article;


use Symfony\Component\HttpKernel\KernelInterface;

class YamlProvider
{

    private $kernel;

    /**
     * YamlProvider constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Récupère les articles depuis le cache
     */
    public function getArticles() {

       # Récupère les articles depuis le cache
        return unserialize( file_get_contents( $this->kernel->getCacheDir() . '/articles.php' ) );

    }
}