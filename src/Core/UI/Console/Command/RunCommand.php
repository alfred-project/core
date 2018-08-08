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

namespace Alfred\Core\UI\Console\Command;

use Alfred\Core\Domain\Configuration\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Comand Run
 *
 * alfred-please run ...
 */
class RunCommand extends Command
{

    /**
     * RunCommand constructor.
     *
     * @param \Alfred\Core\Domain\Configuration\Config $config la configuracion personalizada
     */
    public function __construct(Config $config)
    {
        dump($config);
        parent::__construct('run');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
