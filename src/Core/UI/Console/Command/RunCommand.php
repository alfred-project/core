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



        //Llevar esto al servicio alfred.config

        //Necesito un objeto configuracion, con la lista de perfiles, trabajos y tareas

        //Para crear ese objeto necesito un servicio que se encargue de leer de .alfred/config.yml y parsear el contenido

        //El objeto config, y la interfaz del servicio pertenecen al dominio (son unos trasuntos de modelo y repositorio)
        //Para ser exactos config es un agregado de varios modelos (profiles, jobs y tasks)


        //La implementación del servicio que crea el objeto, pertenece a Infraestructura por que depende del detalle
        //(es un archivo en disco, pero podria ser una llamada a una api, o cualquier movida ajena al dominio)
        //la lógica de parsear el yml, etc tambien depende del detalle (symnfoy)

//        $config = Yaml::parse(
//            file_get_contents(getcwd() . '/.alfred/config.yml')
//        );
//
//        $configs = [$config];
//        $processor = new Processor();
//
//        $configuration = new Configuration();
//        $processed = $processor->processConfiguration($configuration, $configs);
//
//        print_r($processed);
    }
}
