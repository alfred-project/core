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

namespace Alfred\Core\UI\Console;

use Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder;
use Alfred\Core\Infrastructure\DependencyInjection\Parameters;
use PlanB\Cli\MessageExceptionBuilder;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
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
     * @inheritDoc
     */
    protected function getDefaultInputDefinition()
    {
        $definition = parent::getDefaultInputDefinition();

        $definition->addOption(new InputOption(
            'config-file',
            'c',
            InputOption::VALUE_REQUIRED,
            'La ruta del fichero de configuración'
        ));

        $definition->addOption(new InputOption(
            'project-dir',
            'd',
            InputOption::VALUE_REQUIRED,
            'La ruta del projecto que vamos a analizar'
        ));

        return $definition;
    }


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

        if (null === $input) {
            $input = new ArgvInput();
        }

        if (null === $output) {
            $output = new ConsoleOutput();
        }

        $this->tryRun($input, $output);
    }

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
    private function tryRun(?InputInterface $input = null, ?OutputInterface $output = null): void
    {

        try {
            $this->container = $this->buildContainer($input);
            $this->initCommands();
            parent::run($input, $output);
        } catch (\Throwable $exception) {
            $this->showError($exception, $input, $output);
        }
    }

    /**
     * Devuelve el contenedor de dependencias
     *
     * @param null|\Symfony\Component\Console\Input\InputInterface $input
     *
     * @return \Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder
     */
    protected function buildContainer(?InputInterface $input): ContainerBuilder
    {
        $input = $this->bindInput($input);
        $parameters = Parameters::fromArray($input->getOptions());

        $container = ContainerBuilder::create($parameters);

        return $container;
    }

    /**
     * Nos aseguramos de obtener un objeto Input vinculado a la definición de la aplicación
     *
     * @param null|\Symfony\Component\Console\Input\InputInterface $input
     *
     * @return null|\Symfony\Component\Console\Input\ArgvInput|\Symfony\Component\Console\Input\InputInterface
     */
    private function bindInput(?InputInterface $input = null)
    {
        if (!($input instanceof Input)) {
            $input = new ArgvInput();
        }

        $input->bind($this->getDefinition());

        return $input;
    }


    /**
     * Asigna los commandos definidos en la aplicación
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
    protected function initCommands(): void
    {
        $commands = [
            $this->container->get('run.command'),
        ];

        $this->addCommands($commands);
    }

    /**
     * Muestra el mensaje de error por pantalla
     *
     * @param $exception
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function showError($exception, InputInterface $input, OutputInterface $output): void
    {
        $builder = MessageExceptionBuilder::fromException($exception);

        if ($input->getOption('verbose')) {
            $builder->withTrace();
        }

        $message = $builder->build();
        $output->writeln($message->stringify());
    }
}
