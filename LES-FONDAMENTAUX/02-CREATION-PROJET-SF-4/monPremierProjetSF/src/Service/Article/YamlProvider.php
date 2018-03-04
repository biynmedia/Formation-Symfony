<?php

namespace App\Service\Article;

use Symfony\Component\Yaml\Yaml;

class YamlProvider
{

    /**
     * Récupère, parse et retourne les articles depuis articles.yaml
     * @return Array Articles
     */
    public function getArticles() {

        try {
            $articles = Yaml::parseFile(__DIR__.'/articles.yaml');
            return $articles['data'];
        } catch (ParseException $e) {
            printf('Unable to parse the YAML string: %s', $e->getMessage());
        }

        return [];

    }
}