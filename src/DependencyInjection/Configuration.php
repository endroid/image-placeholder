<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\ImagePlaceholderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder
            ->root('endroid_image_placeholder')
                ->children()
                    ->booleanNode('enabled')->isRequired()->end()
                    ->scalarNode('provider')->defaultValue('placehold')->end()
                    ->booleanNode('check_image_exists')->defaultValue(true)->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
