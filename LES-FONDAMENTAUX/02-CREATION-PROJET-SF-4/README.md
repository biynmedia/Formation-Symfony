# Installation de Symfony 4

https://symfony.com/doc/current/index.html
Suivi des étapes de setup : https://symfony.com/doc/current/setup.html
## Installation simple grâce à composer :

### Création du Projet

    composer create-project symfony/website-skeleton my-project

### Lancement du Serveur

     cd my-project
     composer require server --dev
     php bin/console server:run

### Ouverture dans le navigateur

**Composer** à installer pour nous automatiquement toute l'architecture de Symfony.

>http://localhost:8000/

### Barre de Débogage

Observez la barre de débogage. Au fur et à mesure que nous installerons de nouveaux packages, nous verrons de nouvelles options apparaître.

> Petit tour de découverte des options de la barre.

### Installation et Configuration du Plugin Symfony pour PHPStorm

Le plugin symfony pour PHPStorm permettra à notre IDE de reconnaître toutes les fonctionnalités de Symfony. 

**Nous allons installer :**

 1. PHP Annotations
 2. PHP Toolbox
 3. Symfony Plugin

> Nous pouvons ensuite activer le plugin et redémarrer PHPStorm.

### Configuration de PSR-0 PHP Storm
Nous allons enfin, configurer PHPStorm pour résoudre correctement les espaces de noms de notre projet.
> Code / Detecter PSR-0 Namespace Roots

### Découvrir l'Architecture de SF4
> Doc de Référence : https://symfony.com/doc/current/page_creation.html#checking-out-the-project-structure

Written with ❤️ by [Hugo LIEGEARD](https://github.com/hugoliegeard).
