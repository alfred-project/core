<?php
/**
 * This file is part of the planb project.
 *
 * (c) Jose Manuel Pantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Alfred\Core\Domain\Configuration;

use PlanB\Type\Text\TextList;

/**
 * La configuración de un perfil
 */
class Profile
{
    /**
     * @var string
     */
    private $description = '';

    /**
     * @var \PlanB\DS\ItemList\TextList
     */
    private $jobs = [];

    /**
     * Crea una nueva instnacia desde un array
     *
     * @param mixed[] $values
     *
     * @return \Alfred\Core\Domain\Configuration\Service
     */
    public static function fromArray(array $values): self
    {
        $values = array_replace([
            'description' => null,
            'jobs' => [],
        ], $values);

        return array_to_object($values, new static());
    }

    /**
     * Profile constructor.
     */
    private function __construct()
    {
        $this->jobs = TextList::create()
            ->disallowBlank();
    }


    /**
     * Devuelve la descripción del profile
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Asigna la descripción del profile
     *
     * @param string $description
     *
     * @return \Alfred\Core\Domain\Configuration\Profile
     */
    public function setDescription(string $description): Profile
    {
        ensure_text($description)
            ->isNotBlank();

        $this->description = $description;

        return $this;
    }

    /**
     * Devuelve la lista de trabajos que componen este profile
     *
     * @return mixed[]
     */
    public function getJobs(): TextList
    {
        return $this->jobs;
    }

    /**
     * Asigna la lista de trabajos que componen este profile
     *
     * @param mixed[] $jobs
     *
     * @return \Alfred\Core\Domain\Configuration\Profile
     */
    public function setJobs(array $jobs): Profile
    {
        $this->jobs->clearAndSet($jobs);

        return $this;
    }
}
