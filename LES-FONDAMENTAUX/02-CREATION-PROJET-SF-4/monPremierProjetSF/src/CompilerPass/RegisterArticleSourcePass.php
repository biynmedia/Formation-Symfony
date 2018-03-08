<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 06/03/2018
 * Time: 22:12
 */

namespace App\CompilerPass;


use App\Mediator\Article\ArticleMediator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterArticleSourcePass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {

        /**
         * Si jamais il n'y a pas de médiateur, on ne le charge pas...
         */
        if(!$container->hasDefinition(ArticleMediator::class)) {
            return;
        }

        $mediatorDefinition = $container->getDefinition(ArticleMediator::class);
        $taggedServices = $container->findTaggedServiceIds('app.article_source');

        foreach ($taggedServices as $serviceId => $info) {

            $mediatorDefinition->addMethodCall('addSource',[
               new Reference($serviceId)
            ]);
        }

    }
}