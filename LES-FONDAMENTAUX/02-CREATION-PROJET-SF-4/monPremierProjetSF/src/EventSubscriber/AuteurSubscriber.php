<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 04/03/2018
 * Time: 23:21
 */

namespace App\EventSubscriber;


use App\Entity\Auteur;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class AuteurSubscriber implements EventSubscriberInterface
{

    private $manager;

    # https://stackoverflow.com/questions/10285783/difference-between-objectmanager-and-entitymanager-in-symfony2
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        # Récupération du Token de connexion de l'utilisateur
        $token = $event->getAuthenticationToken();

        if (!$token instanceof UsernamePasswordToken) {
            throw new \RuntimeException(sprintf('Authentication token must be a %s instance.', UsernamePasswordToken::class));
        }

        # Récupération du Membre via son token
        $auteur = $token->getUser();


        if ($auteur instanceof Auteur) {
            # Mise à jour du Timestamp
            $auteur->setDerniereconnexion();
            # Sauvegarde en BDD
            $this->manager->flush();
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin'
        ];
    }
}