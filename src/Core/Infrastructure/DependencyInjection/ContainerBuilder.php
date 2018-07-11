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

namespace Alfred\Core\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as BaseContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Contenedor de dependencias
 */
class ContainerBuilder extends BaseContainerBuilder
{

    /**
     * Crea una nueva instancia, debidamente configurada
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    public static function loadAll(): self
    {

        return (new self())->init();
    }

    /**
     * Define parámetros y servicios
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    protected function init(): self
    {
        $root = realpath(__DIR__.'/../../../../');
        $this->setParameter('root_dir', $root);


        $loader = new XmlFileLoader($this, new FileLocator($root.'/config'));

        $loader->load('twig.xml');

        return $this;
    }
}
