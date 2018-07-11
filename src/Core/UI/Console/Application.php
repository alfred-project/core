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
     * Ejecuta la aplicación
     *
     * @param null|\Symfony\Component\Console\Input\InputInterface   $input
     * @param null|\Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|void
     *
     * @throws \Exception
     */
    public function run(?InputInterface $input = null, ?OutputInterface $output = null)
    {
        $this->container = ContainerBuilder::loadAll();

        $commands = $this->getCommands();
        $this->addCommands($commands);

        parent::run($input, $output);
    }

    /**
     * Devuelve un array con los commandos definidos en la aplicación
     *
     * alfred-please init
     *
     * alfred-please run profile <profile>
     * alfred-please run job <job>
     * alfred-please run task <job>:<task>
     *
     * alfred-please show config
     *
     * @return \Symfony\Component\Console\Command\Command[]
     *
     * @throws \Exception
     */
    private function getCommands(): array
    {
        return [
            $this->container->get('run.command'),
        ];
    }
}
