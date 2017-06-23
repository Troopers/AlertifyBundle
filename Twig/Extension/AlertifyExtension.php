<?php

namespace Troopers\AlertifyBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Session;
use Troopers\AlertifyBundle\Handler\AlertifySessionHandler;

/**
 * AlertifyExtension.
 */
class AlertifyExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
    /**
     * @var AlertifySessionHandler
     */
    private $alertifySessionHandler;

    /**
     * AlertifyExtension constructor.
     *
     * @param AlertifySessionHandler $alertifySessionHandler
     */
    public function __construct(AlertifySessionHandler $alertifySessionHandler)
    {
        $this->alertifySessionHandler = $alertifySessionHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'alertify';
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('alertify', [$this, 'alertifyFilter'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * Alertify filter.
     *
     * @param \Twig_Environment $environment
     * @param Session           $session
     *
     * @return string
     */
    public function alertifyFilter($environment, Session $session)
    {
        return $this->alertifySessionHandler->handle($session, $environment);
    }
}
