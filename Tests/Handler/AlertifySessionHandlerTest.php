<?php

namespace Troopers\AlertifyBundle\Tests\Helper;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Troopers\AlertifyBundle\DependencyInjection\TroopersAlertifyExtension;
use Troopers\AlertifyBundle\Handler\AlertifySessionHandler;
use Troopers\AlertifyBundle\Helper\AlertifyHelper;
use Twig\Environment;

class AlertifySessionHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Environment
     */
    protected $twigEnvironment;
    /**
     * @var Session
     */
    protected $session;

    public function testDefault()
    {
        $this->mockSession();
        $container = new ContainerBuilder();
        $loader = new TroopersAlertifyExtension();
        $loader->load([[]], $container);
        /** @var AlertifyHelper $helper */
        $helper = new AlertifyHelper($this->session);
        $handler = new AlertifySessionHandler(
            $container->getParameter('troopers_alertify')
        );
        $twig = $this->getTwigEnvironmentMock();

        $helper->congrat('Alert1');
        $this->assertEquals(1, count(explode(' ', $handler->handle($this->session, $twig))));
        $helper->congrat('Alert2');
        $helper->congrat('Alert3', ['opt1' => 42]);
        $helper->congrat('Alert4');
        $this->assertEquals(3, count(explode(' ', $handler->handle($this->session, $twig))));
    }

    /**
     * @return Session
     */
    protected function mockSession()
    {
        $this->session = new Session(new MockArraySessionStorage());
    }

    protected function getTwigEnvironmentMock()
    {
        $twigEnvironment = $this->getMockBuilder(Environment::class)
            ->disableOriginalConstructor()
            ->setMethods(['render'])
            ->getMock();

        return $twigEnvironment;
    }
}
