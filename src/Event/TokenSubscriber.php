<?php

namespace App\Event;

use App\Controller\PrivController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface

{
    private $tokens;

    public function __construct($tokens = ['sec'])
    {
        $this->tokens = $tokens;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof PrivController) {
            $token = $event->getRequest()->query->get('token');
            if (!in_array($token, $this->tokens, true)) {
                throw new AccessDeniedHttpException('This action needs a valid token!');
            }

            $event->getRequest()->attributes->set('auth_token', $token);
        }
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        // check to see if onKernelController marked this as a token "auth'ed" request
        if (!$token = $event->getRequest()->attributes->get('auth_token')) {
            return;
        }

        $response = $event->getResponse();

        // create a hash and set it as a response header
        $hash = sha1($response->getContent().$token);
        $response->headers->set('X-CONTENT-HASH', $hash);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}