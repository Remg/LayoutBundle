<?php

namespace Remg\LayoutBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class RemgLayoutExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // Configure Assetic Bundle
        $container->prependExtensionConfig('assetic', [
            'bundles' => [
                'RemgLayoutBundle'
            ],
            'filters' => [
                'jsqueeze' => null,
                'cssrewrite' => null,
                'scssphp' => [
                    'formatter' => 'Leafo\ScssPhp\Formatter\Compressed'
                ]
            ]
        ]);
        // Configure Liip Imagine Bundle
        $container->prependExtensionConfig('liip_imagine', [
            'resolvers' => [
                'assets' => [
                    'web_path' => [
                        'cache_prefix' => 'assets/images'
                    ]
                ]
            ],
            'filter_sets' => [
                'square_32' => [
                    'quality' => 75,
                    'filters' => [
                        'thumbnail' => [
                            'size' => [32, 32],
                            'mode' => 'outbound'
                        ]
                    ]
                ],
                'square_100' => [
                    'quality' => 75,
                    'filters' => [
                        'thumbnail' => [
                            'size' => [100, 100],
                            'mode' => 'outbound'
                        ]
                    ]
                ],
                'w210' => [
                    'quality' => 75,
                    'filters' => [
                        'thumbnail' => [
                            'size' => [210, 90],
                            'mode' => 'outbound'
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        // Available locales
        $container->setParameter('available_locales', ['fr', 'en']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $serviceDefintion = $container->getDefinition('remg_admin_paginator');
        $serviceDefintion->addMethodCall('setTemplates', [$config['admin']['paginator']['templates']]);
    }
}
