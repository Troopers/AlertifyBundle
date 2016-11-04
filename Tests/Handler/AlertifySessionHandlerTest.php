<?php

namespace Troopers\AlertifyBundle\Tests\Helper;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use Troopers\AlertifyBundle\DependencyInjection\TroopersAlertifyExtension;
use Troopers\AlertifyBundle\Handler\AlertifySessionHandler;
use Troopers\AlertifyBundle\Helper\AlertifyHelper;

class AlertifySessionHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Twig_Environment
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
            $this->getTwigEnvironmentMock(),
            $container->getParameter('troopers_alertify')
        );

        $helper->congrat('Alert1');
        $this->assertEquals(1, count(explode(' ', $handler->handle($this->session))));
        $helper->congrat('Alert2');
        $helper->congrat('Alert3', ['opt1'=> 42]);
        $helper->congrat('Alert4');
        $this->assertEquals(3, count(explode(' ', $handler->handle($this->session))));
    }

    /**
     * @return Session
     */
    protected function mockSession() {
        $this->session = new Session(new MockArraySessionStorage());
    }

    protected function getTwigEnvironmentMock()
    {
        $twigEnvironment = $this->getMockBuilder('Twig_Environment')
            ->setMethods(['render'])
            ->getMock();

        return $twigEnvironment;
    }

}