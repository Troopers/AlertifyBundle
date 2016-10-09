<?php

namespace Troopers\AlertifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('troopers_alertify');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('default')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('context')->defaultValue('front')->cannotBeEmpty()->end()
                        ->scalarNode('engine')->defaultValue('toastr')->cannotBeEmpty()->end()
                        ->scalarNode('layout')->defaultNull()->end()
                        ->scalarNode('translationDomain')->defaultValue('alertify')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('contexts')
                    ->useAttributeAsKey(true)
                    ->prototype('array')
                    ->children()
                        ->scalarNode('engine')->defaultValue('toastr')->cannotBeEmpty()->end()
                        ->scalarNode('layout')->defaultNull()->end()
                        ->scalarNode('translationDomain')->defaultValue('alertify')->cannotBeEmpty()->end()
                        ->scalarNode('timeout')->defaultNull()->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey(true)
                            ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
