<?php

namespace AppVentus\Awesome\AlertifyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AvAwesomeAlertifyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('av_awesome_alertify', $config);
        $container->setParameter('av_awesome_alertify.contexts', $config['contexts']);
        $container->setParameter('av_awesome_alertify.default.context', $config['default']['context']);
        $container->setParameter('av_awesome_alertify.default.engine', $config['default']['engine']);
        $container->setParameter('av_awesome_alertify.default.layout', $config['default']['layout']);
        $container->setParameter('av_awesome_alertify.default.translationDomain', $config['default']['translationDomain']);

        foreach ($config['contexts'] as $key => $value) {
            $container->setParameter('av_awesome_alertify.contexts.'.$key, $value);
        }
    }
}
