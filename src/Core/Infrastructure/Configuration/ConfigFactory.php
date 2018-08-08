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

use Alfred\Core\Domain\Configuration\Config;
use PlanB\Type\Path\Path;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

/**
 * Factory para leer y parsear objetos Config
 */
class ConfigFactory
{
    public const ALLOWED_EXTENSIONS = ['yml', 'yaml'];

    /**
     * Crea un objeto configuración, a partir de la ruta del fichero config
     *
     * @param string $configPath
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public function create(string $configPath): Config
    {
        $path = ensure_path($configPath)
            ->isReadableFileWithExtension(...self::ALLOWED_EXTENSIONS)
            ->end();

        $config = $this->getNormalizedConfig($path);

        return Config::fromArray($config);
    }

    /**
     * Devuelve un array de configuración valido a partir del contenido del fichero de configuración
     * y de los valores por defecto
     *
     * @param \PlanB\Type\Path\Path $path
     *
     * @return mixed[]
     */
    private function getNormalizedConfig(Path $path): array
    {
        $default = [
            'services' => [
                //composer => [
                //className => '\PlanB\Alfred\Services\Composer'
                //etc
                //]
            ],

        ];

        $content = $this->readFromCustomFile($path);

        return $this->processConfig($content, $default);
    }

    /**
     * Lee el contenido del fichero de configuración y lo devuelve el forma de array
     *
     * @param \PlanB\Type\Path\Path $path
     *
     * @return mixed[]
     */
    private function readFromCustomFile(Path $path): array
    {
        $extension = $path->getExtension();

        $config = [];
        switch ($extension) {
            case 'yml':
            case 'yaml':
                $config = Yaml::parseFile($path->stringify());
                break;
        }

        return $config;
    }

    /**
     * Comprueba que el array defnido en el fichero de configuración cumple con la definición
     *
     * @param mixed[] $custom
     *
     * @param mixed[] $default
     *
     * @return mixed[]
     */
    public function processConfig(array $custom, array $default = []): array
    {
        $configs = array($custom, $default);

        $processor = new Processor();
        $definition = new Definition();

        $processed = $processor->processConfiguration(
            $definition,
            $configs
        );

        return $processed;
    }
}
