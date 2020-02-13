<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Rompetomp\InertiaBundle\Service\InertiaInterface;

class InertiaSubscriber implements EventSubscriberInterface
{
    protected $inertia;

    public function __construct(InertiaInterface $inertia)
    {
        $this->inertia = $inertia;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $session = $event->getRequest()->getSession();
        // foreach ($session->getFlashBag()->all() as $key => $flash) {
        //     $this->inertia->share('messages', [$key => $flash]);
        // }
        // $messages = [];
        // foreach($session->getFlashBag()->all() as $flash) {

        // }
        $this->inertia->share('messages', $session->getFlashBag()->all());
        //$this->inertia->share('app', ['name' => 'A BIG TEST']);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController'
        ];
    }
}
