<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\ImagePlaceholderBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class EndroidImagePlaceholderExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $imagePlaceholderService = $container->getDefinition('endroid.image_placeholder.service');
        $imagePlaceholderService->addMethodCall('setProviderName', array($config['provider']));
        $imagePlaceholderService->addMethodCall('setEnabled', array($config['enabled']));
        $imagePlaceholderService->addMethodCall('setCheckImageExists', array($config['check_image_exists']));
    }
}
