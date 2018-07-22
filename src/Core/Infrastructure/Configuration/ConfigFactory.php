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

/**
 * Factory para leer y parsear objetos Config
 */
class ConfigFactory
{

    /**
     * Crea un objeto configuración, a partir de la ruta del fichero config
     *
     * @param string $configPath
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public function create(string $configPath): Config
    {

        return new Config($configPath);
    }
}
