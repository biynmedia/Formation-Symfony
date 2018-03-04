<?php

namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NewsletterSubscriber implements EventSubscriberInterface
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {

        # On s'assure que la requète viens de l'utilisateur et non de Symfony en interne
        if (!$event->isMasterRequest() || $event->getRequest()->isXmlHttpRequest()) {
            return;
        }

        # Aperçu des données en session
        # dump($this->session->all());

        # Suppression des données en session
        # $this->session->remove('inviteUser');
        # $this->session->remove('nbUserView');

        # Au bout de la quatrième visites de l'utilisateur on lui propose la newsletter...
        # http://php.net/manual/fr/migration70.new-features.php
        $this->session->set('nbUserView', $this->session->get('nbUserView', 0) + 1);
        if($this->session->get('nbUserView') === 4) :
            $this->session->set('inviteUser', true);
        endif;

    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest() || $event->getRequest()->isXmlHttpRequest()) {
            return;
        }

        if($this->session->get('nbUserView') === 4) :
            $this->session->set('inviteUser', false);
        endif;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST   => 'onKernelRequest',
            KernelEvents::RESPONSE  => 'onKernelResponse'
        ];
    }
}