<?php

// Listener de la traduction

namespace App\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LocaleSubscriber implements EventSubscriberInterface
{
    private $defautLocale;

    public function __construct(string $defautLocale = "fr")
    {
        $this->defautLocale = $defautLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession())
        {return;}

        if ($locale = $request->attributes->get('_locale'))
        {$request->getSession()->set('_locale', $locale);}

        else
        {$request->setLocale($request->getSession()->get('_locale', $this->defautLocale));}
    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::REQUEST => [['onKernelRequest', 17]]
        ];
    }
}