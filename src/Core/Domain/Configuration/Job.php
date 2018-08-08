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

/**
 * La configuración de un trabajo (conjunto de tareas)
 */
class Job
{

    /**
     * @var bool
     */
    private $stopOnFail = false;

    /**
     * @var bool
     */
    private $async = false;


    /**
     * @var \Alfred\Core\Domain\Configuration\TaskList
     */
    private $tasks;

    /**
     * Job constructor.
     */
    private function __construct()
    {
        $this->tasks = TaskList::create();
    }

    /**
     * Crea una nueva instancia desde un array con los datos
     *
     * @param mixed[] $values
     *
     * @return \Alfred\Core\Domain\Configuration\Job
     */
    public static function fromArray(array $values): self
    {
        $values = array_replace([

        ], $values);

        return array_to_object($values, new static());
    }

    /**
     * Indica si el trabajo debe detenerse al primer fallo
     *
     * @return bool
     */
    public function isStopOnFail(): bool
    {
        return $this->stopOnFail;
    }

    /**
     * Establece si el trabajo debe deternser al primer fallo
     *
     * @param bool $stopOnFail
     *
     * @return \Alfred\Core\Domain\Configuration\Job
     */
    public function setStopOnFail(bool $stopOnFail): Job
    {
        $this->stopOnFail = $stopOnFail;

        return $this;
    }

    /**
     * Indica si el trabajo se debe ser asincrono
     *
     * @return bool
     */
    public function isAsync(): bool
    {
        return $this->async;
    }

    /**
     * Establece si el trabajo debe ser asincrono
     *
     * @param bool $async
     *
     * @return \Alfred\Core\Domain\Configuration\Job
     */
    public function setAsync(bool $async): Job
    {
        $this->async = $async;

        return $this;
    }

    /**
     * Devuelve la lista de Tareas
     *
     * @return \Alfred\Core\Domain\Configuration\TaskList
     */
    public function getTasks(): TaskList
    {
        return $this->tasks;
    }

    /**
     * Asigna la lista de tareas
     *
     * @param mixed[] $tasks
     *
     * @return \Alfred\Core\Domain\Configuration\Job
     */
    public function setTasks(iterable $tasks): Job
    {
        $this->tasks->clearAndSet($tasks);

        return $this;
    }
}
