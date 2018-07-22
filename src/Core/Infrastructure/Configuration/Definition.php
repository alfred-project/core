<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Alfred\Core\Infrastructure\Configuration;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Validación del array configuracion
 */
class Definition implements ConfigurationInterface
{

    /**
     * @inheritdoc
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder|\Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('alfred');

        $root = $rootNode->children();
        $this->defineProfiles($root);

        return $treeBuilder;
    }

    /**
     * Define el nodo profiles en el array de configuración
     *
     * @param \Symfony\Component\Config\Definition\Builder\NodeBuilder $root
     */
    protected function defineProfiles(NodeBuilder $root): void
    {
        $root->arrayNode('profiles')
            ->arrayPrototype()
                ->children()
                    ->scalarNode('description')->end()
                        ->arrayNode('jobs')
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
