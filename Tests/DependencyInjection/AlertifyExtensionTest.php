<?php

namespace Troopers\AlertifyBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Troopers\AlertifyBundle\DependencyInjection\TroopersAlertifyExtension;

class AlertifyExtensionTest extends \PHPUnit\Framework\TestCase
{
    public function testDefault()
    {
        $container = new ContainerBuilder();
        $loader = new TroopersAlertifyExtension();
        $loader->load([[]], $container);
        $this->assertTrue($container->hasDefinition('alertify'), 'The alertify service exists');
        $this->assertEquals('Troopers\\AlertifyBundle\\Twig\\Extension\\AlertifyExtension', $container->getParameter('alertify.twig.extension.class'));
        $this->assertEquals('Troopers\\AlertifyBundle\\Handler\\AlertifySessionHandler', $container->getParameter('alertify.handler.session.class'));
        $this->assertEquals('Troopers\\AlertifyBundle\\Helper\\AlertifyHelper', $container->getParameter('alertify.helper.class'));
        $this->assertEquals('Troopers\\AlertifyBundle\\EventListener\\AlertifyListener', $container->getParameter('alertify.event_listener'));
        $this->assertEquals([
            'default' => [
                'context'           => 'front',
                'engine'            => 'toastr',
                'layout'            => null,
                'translationDomain' => 'alertify',
            ],
            'contexts' => [],
        ], $container->getParameter('troopers_alertify'));
        $this->assertEquals([], $container->getParameter('troopers_alertify.contexts'));
        $this->assertEquals('front', $container->getParameter('troopers_alertify.default.context'));
        $this->assertEquals('toastr', $container->getParameter('troopers_alertify.default.engine'));
        $this->assertEquals(null, $container->getParameter('troopers_alertify.default.layout'));
        $this->assertEquals('alertify', $container->getParameter('troopers_alertify.default.translationdomain'));
    }

    public function testContexts()
    {
        $container = new ContainerBuilder();
        $loader = new TroopersAlertifyExtension();
        $loader->load([[
            'contexts' => [
                'front' => [
                    'engine'  => 'notie',
                    'options' => [
                        'animationDelay' => 300,
                    ],
                ],
                'back' => [
                    'engine'            => 'pushjs',
                    'translationDomain' => 'admin',
                ],
            ],
            'default' => [
                'engine' => 'notie',
            ], ]], $container);
        $this->assertSame([
            'contexts' => [
                'front' => [
                    'engine'  => 'notie',
                    'options' => [
                        'animationDelay' => 300,
                    ],
                    'layout'            => null,
                    'translationDomain' => 'alertify',
                    'timeout'           => null,
                ],
                'back' => [
                    'engine'            => 'pushjs',
                    'translationDomain' => 'admin',
                    'layout'            => null,
                    'timeout'           => null,
                    'options'           => [],
                ],
            ],
            'default' => [
                'engine'            => 'notie',
                'context'           => 'front',
                'layout'            => null,
                'translationDomain' => 'alertify',
            ],
        ], $container->getParameter('troopers_alertify'));

        $this->assertEquals([
            'front' => [
                'engine'            => 'notie',
                'layout'            => null,
                'translationDomain' => 'alertify',
                'timeout'           => null,
                'options'           => [
                    'animationDelay' => 300,
                ],
            ],
            'back' => [
                'engine'            => 'pushjs',
                'translationDomain' => 'admin',
                'layout'            => null,
                'timeout'           => null,
                'options'           => [],
            ],
        ], $container->getParameter('troopers_alertify.contexts'));
        $this->assertEquals('front', $container->getParameter('troopers_alertify.default.context'));
        $this->assertEquals('notie', $container->getParameter('troopers_alertify.default.engine'));
        $this->assertEquals(null, $container->getParameter('troopers_alertify.default.layout'));
        $this->assertEquals('alertify', $container->getParameter('troopers_alertify.default.translationdomain'));
    }
}
