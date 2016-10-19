<?php

namespace Troopers\AlertifyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TroopersAlertifyExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('troopers_alertify', $config);
        $container->setParameter('troopers_alertify.contexts', $config['contexts']);
        $container->setParameter('troopers_alertify.default.context', $config['default']['context']);
        $container->setParameter('troopers_alertify.default.engine', $config['default']['engine']);
        $container->setParameter('troopers_alertify.default.layout', $config['default']['layout']);
        $container->setParameter('troopers_alertify.default.translationDomain', $config['default']['translationDomain']);

        foreach ($config['contexts'] as $key => $value) {
            $container->setParameter('troopers_alertify.contexts.'.$key, $value);
        }
    }
}
