<?php

namespace Remg\LayoutBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('remg_layout');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('admin')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('paginator')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('pagination')
                                            ->defaultValue('RemgLayoutBundle:admin:pagination/sliding.html.twig')
                                        ->end()
                                        ->scalarNode('sortable')
                                            ->defaultValue('RemgLayoutBundle:admin:pagination/sortable_link.html.twig')
                                        ->end()
                                    ->end()
                                ->end() // templates
                            ->end()
                        ->end() // paginator
                    ->end()
                ->end() // admin
                ->arrayNode('frontend')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('paginator')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('pagination')
                                            ->defaultValue('KnpPaginatorBundle:Pagination:twitter_bootstrap_v3_pagination.html.twig')
                                        ->end()
                                        ->scalarNode('sortable')
                                            ->defaultValue('RemgLayoutBundle:frontend:pagination/sortable_link.html.twig')
                                        ->end()
                                    ->end()
                                ->end() // templates
                            ->end()
                        ->end() // paginator
                    ->end()
                ->end() // frontend
            ->end()
        ;

        return $treeBuilder;
    }
}
