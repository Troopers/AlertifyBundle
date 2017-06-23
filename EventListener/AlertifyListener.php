<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Troopers\AlertifyBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Troopers\AlertifyBundle\Handler\AlertifySessionHandler;

/**
 * AlertifyListener append the alertify views to the response.
 *
 * @author Leny Bernard <leny@troopers.email>
 */
class AlertifyListener implements EventSubscriberInterface
{
    protected $alertifySessionHandler;
    /**
     * @var Session
     */
    private $session;
    private $twig;

    /**
     * AlertifyListener constructor.
     *
     * @param Session                $session
     * @param AlertifySessionHandler $alertifySessionHandler
     */
    public function __construct(\Twig_Environment $twig, Session $session, AlertifySessionHandler $alertifySessionHandler)
    {
        $this->twig = $twig;
        $this->session = $session;
        $this->alertifySessionHandler = $alertifySessionHandler;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $request = $event->getRequest();

        $this->injectAlertify($response, $request);
    }

    /**
     * Injects the alertify view into the given Response just before </body> tag.
     */
    protected function injectAlertify(Response $response, Request $request)
    {
        if ($response instanceof RedirectResponse) {
            return;
        }

        $content = $response->getContent();
        $endBodyPos = strripos($content, '</body>');
        $hasBody = false !== $endBodyPos;
        $hasMetaRefresh = false !== strripos($content, 'http-equiv="refresh"');
        $isRedirectResponse = $response instanceof RedirectResponse;

        if ($hasBody && !$hasMetaRefresh && !$isRedirectResponse) {
            $alertify = $this->alertifySessionHandler->handle($this->session, $this->twig);
            $content = substr($content, 0, $endBodyPos).$alertify.substr($content, $endBodyPos);
            $response->setContent($content);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }
}
