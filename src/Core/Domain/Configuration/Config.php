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

namespace Alfred\Core\Domain\Configuration;

/**
 * Representa a la configuración personalizada de un proyecto
 */
class Config
{

    /**
     * @var \Alfred\Core\Domain\Configuration\ServiceList
     */
    private $services;

    /**
     * @var \Alfred\Core\Domain\Configuration\ProfileList
     */
    private $profiles;

    /**
     * @var \Alfred\Core\Domain\Configuration\JobList
     */
    private $jobs;

    /**
     * Config constructor.
     */
    private function __construct()
    {
        $this->services = ServiceList::create();
        $this->profiles = ProfileList::create();
        $this->jobs = JobList::create();
    }

    /**
     * Crea una nueva instancia
     *
     * @param mixed[] $values
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public static function fromArray(array $values): self
    {

        return array_to_object($values, new static());
    }

    /**
     * Devuelve la lista de Servicios
     *
     * @return \Alfred\Core\Domain\Configuration\ServiceList
     */
    public function getServices(): ServiceList
    {
        return $this->services;
    }

    /**
     * Asigna la lista de Servicios
     *
     * @param mixed[] $services
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public function setServices(iterable $services): Config
    {
        $this->services->clearAndSet($services);

        return $this;
    }

    /**
     * Devuelve la lista de perfiles
     *
     * @return \Alfred\Core\Domain\Configuration\ProfileList
     */
    public function getProfiles(): ProfileList
    {
        return $this->profiles;
    }

    /**
     * Asigna la lista de Perfiles
     *
     * @param mixed[] $profiles
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public function setProfiles(iterable $profiles): Config
    {
        $this->profiles->clearAndSet($profiles);

        return $this;
    }

    /**
     * Devuelve la lista de Trabajos
     *
     * @return \Alfred\Core\Domain\Configuration\JobList
     */
    public function getJobs(): JobList
    {
        return $this->jobs;
    }

    /**
     * Asgina la lista de Trabajos
     *
     * @param mixed[] $jobs
     *
     * @return \Alfred\Core\Domain\Configuration\Config
     */
    public function setJobs(iterable $jobs): Config
    {
        $this->jobs->clearAndSet($jobs);

        return $this;
    }
}
