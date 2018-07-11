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

namespace Alfred\Core\Ui\Console;

use Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Define como se ejecuta la aplicación desde la linea de comandos
 */
class Application extends ConsoleApplication
{
    /**
     * @var \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->container = ContainerBuilder::loadAll();

        var_dump(get_class($this->container->get('twig')));

        return parent::doRun($input, $output);
    }
}
