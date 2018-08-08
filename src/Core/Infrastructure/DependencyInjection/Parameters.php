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

use Alfred\Core\Infrastructure\Configuration\ConfigFactory;
use PlanB\Type\Path\Path;

/**
 * Representa al conjunto de parámetros que configuran la aplicación
 *
 * Normalmente provienen de la linea de comandos
 */
class Parameters implements \IteratorAggregate
{
    public const  DEFAULT_CONFIG_DIRECTORY = '.alfred';
    public const  DEFAULT_CONFIG_FILENAME = 'config.yml';

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var string
     */
    private $configFile;

    /**
     * Crea una nueva instancia a partir de un array de valores
     *
     * @param mixed[] $values
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\Parameters
     */
    public static function fromArray(iterable $values = []): self
    {
        $values = array_filter($values);

        return array_to_object($values, static::class);
    }

    /**
     * Devuelve la ruta del proyecto
     *
     * @return string
     */
    public function getProjectDir(): string
    {
        if (is_null($this->projectDir)) {
            $this->setProjectDir(getcwd());
        }

        return $this->projectDir;
    }

    /**
     * Asigna la ruta del proyecto
     *
     * @param string $projectDir
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\Parameters
     */
    public function setProjectDir(string $projectDir): Parameters
    {

        $path = ensure_path($projectDir)
            ->isDirectory()
            ->stringify();

        $this->projectDir = $path;

        return $this;
    }

    /**
     * Devuelve la ruta del fichero de configuración
     *
     * @return string
     */
    public function getConfigFile(): string
    {
        if (is_null($this->configFile)) {
            $default = $this->getDefaultConfigFile();
            $this->setConfigFile($default);
        }

        return $this->configFile;
    }

    /**
     * Devuelve la ruta por defecto del fichero de configuración
     *
     * @return string
     */
    private function getDefaultConfigFile(): string
    {
        return Path::normalize(...[
            $this->getProjectDir(),
            self::DEFAULT_CONFIG_DIRECTORY,
            self::DEFAULT_CONFIG_FILENAME,
        ]);
    }

    /**
     * Asigna la ruta del fichero de configuración
     *
     * @param string $configFile
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\Parameters
     */
    public function setConfigFile(string $configFile): Parameters
    {

        $path = ensure_path($configFile)
            ->isReadableFileWithExtension(...ConfigFactory::ALLOWED_EXTENSIONS)
            ->stringify();

        $this->configFile = $path;

        return $this;
    }

    /**
     * Devuelve el Iterador
     *
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator(object_to_array($this, '-'));
    }
}
