<?php

namespace App\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NewsletterListener implements EventSubscriberInterface
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }

    public function onKernelResponse(FilterResponseEvent $event) {

        # $response = $event->getResponse();
        # $request  = $event->getRequest();

        # On s'assure que la requète viens de l'utilisateur et non de Symfony en interne
        if (!$event->isMasterRequest()) {
            return;
        }

        # Aperçu des données en session
        # dump($this->session->all());

        # Suppression des données en session
        # $this->session->remove('isUserInvited');

        if(!$this->session->get('isUserInvited')) {
            $this->session->set('isUserInvited', true);
        }

    }
}