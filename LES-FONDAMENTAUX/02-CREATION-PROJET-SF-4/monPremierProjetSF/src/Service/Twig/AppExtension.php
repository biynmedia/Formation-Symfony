<?php

namespace App\Service\Twig;


use App\Controller\Helper;
use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{

    use Helper;

    private $router;
    private $session;

    public function __construct(UrlGeneratorInterface $router, SessionInterface $session)
    {
        $this->router = $router;
        $this->session = $session;
    }

    public function getFilters()
    {
        return [
            new \Twig_Filter('accroche',function($text) {

                # Supprimer toutes les balises HTML
                $string = strip_tags($text);

                # Si ma chaine de caractère est supérieur à 170
                # Je poursuis, sinon c'est inutile
                if(strlen($string) > 170) :

                    # Je coupe ma chaine à 170.
                    $stringCut = substr($string, 0, 170);

                    # Je m'assure que je ne coupe pas de mot !
                    $string = substr($stringCut, 0,
                        strrpos($stringCut, ' '));

                endif;

                # On retourne l'accroche
                return $string . '...';

            }), # -- Fin de Twig Filter Accroche

            new \Twig_Filter('slugify', function($text) {

                return $this->slugify($text);

            }), # -- Fin de Twig Filter Slugify

            new \Twig_Filter('artlink', function(Article $article) {
                return $this->router->generate('index_article', [
                    'libellecategorie'  => $this->slugify($article->getCategorie()->getLibelle()),
                    'slugarticle'       => $this->slugify($article->getTitre()),
                    'id'                => $article->getId()
                ]);
            }), # -- Fin de Twig Filter artlink

            new \Twig_Filter('catlink', function(Categorie $categorie) {
                return $this->router->generate('index_categorie', [
                    'libellecategorie'  => $this->slugify($categorie->getLibelle())
                ]);
            }) # -- Fin de Twig Filter artlink

        ]; # -- Fin du Array

    }  # -- Fin de getFilters

    public function getFunctions()
    {
        return [

            new \Twig_Function('isUserInvited', function() {

//                $this->session->set('nbUserView', $this->session->get('nbUserView') + 1);
                return $this->session->get('inviteUser');

            })

        ];
    }


}
