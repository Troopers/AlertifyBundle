<?php

namespace Troopers\AlertifyBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Session;
use Troopers\AlertifyBundle\Handler\AlertifySessionHandler;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AlertifyExtension extends AbstractExtension
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
            new TwigFilter('alertify', [$this, 'alertifyFilter'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * Alertify filter.
     *
     * @param Environment $environment
     * @param Session     $session
     *
     * @return string
     */
    public function alertifyFilter(Environment $environment, Session $session)
    {
        return $this->alertifySessionHandler->handle($session, $environment);
    }
}
