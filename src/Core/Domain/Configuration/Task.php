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

use PlanB\DS\ItemList\ItemList;

/**
 * Configuración de una tarea de un trabajo
 */
class Task
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $action;

    /**
     * @var \PlanB\DS\ItemList\ItemList
     */
    private $params;

    /**
     * Task constructor.
     */
    private function __construct()
    {
        $this->params = ItemList::create();
    }

    /**
     * Crea una nueva instancia desde un array con valores
     *
     * @param mixed[] $values
     *
     * @return \Alfred\Core\Domain\Configuration\Task
     */
    public static function fromArray(array $values): self
    {
        $values = array_replace([
            'service' => null,
        ], $values);

        return array_to_object($values, new static());
    }

    /**
     * Devuelve el nombre del servicio
     *
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Asigna el nombre del servicio
     *
     * @param string $service
     *
     * @return \Alfred\Core\Domain\Configuration\Task
     */
    public function setService(string $service): Task
    {
        ensure_text($service)
            ->isNotBlank();

        $this->service = $service;

        return $this;
    }

    /**
     * Devuelve la acción
     * (o nulo, si queremos la acción por defecto)
     *
     * @return null|string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Asigna la acción
     *
     * @param string $action
     *
     * @return \Alfred\Core\Domain\Configuration\Task
     */
    public function setAction(string $action): Task
    {
        ensure_text($action)
            ->isNotBlank();

        $this->action = $action;

        return $this;
    }

    /**
     * Devuelve la lista de parámetros
     *
     * @return \PlanB\DS\ItemList\ItemList
     */
    public function getParams(): ItemList
    {
        return $this->params;
    }

    /**
     * Asigna la lista de parámetros
     *
     * @param mixed[] $params
     *
     * @return \Alfred\Core\Domain\Configuration\Task
     */
    public function setParams(iterable $params): Task
    {
        $this->params->clearAndSet($params);

        return $this;
    }
}
