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
     * @param \Alfred\Core\Infrastructure\DependencyInjection\Parameters $parameters
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    public static function create(Parameters $parameters): self
    {
        return (new self())->boot($parameters);
    }

    /**
     * Define parámetros y servicios
     *
     * @param \Alfred\Core\Infrastructure\DependencyInjection\Parameters $parameters
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    protected function boot(Parameters $parameters): self
    {

        $this->initParameters($parameters);
        $this->loadServices();

        return $this;
    }

    /**
     * Asigna los parámetros
     *
     * @param string[] $parameters
     */
    private function initParameters(Parameters $parameters): void
    {
        foreach ($parameters as $name => $value) {
            $this->setParameter($name, $value);
        }
    }

    /**
     * Asigna los servicios definidos en los archivos de configuración
     */
    private function loadServices(): void
    {
        $loader = $this->getLoader();

        $loader->load('twig.xml');
        $loader->load('services.xml');
        $loader->load('cli.xml');
    }

    /**
     * Crea el objeto Loader, para leer los ficheros de configuración
     *
     * @return \Symfony\Component\DependencyInjection\Loader\XmlFileLoader
     */
    private function getLoader(): XmlFileLoader
    {
        $rootDir = realpath(__DIR__.'/../../../../');
        $loader = new XmlFileLoader($this, new FileLocator($rootDir.'/config'));

        return $loader;
    }
}
