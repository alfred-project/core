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

use Alfred\Core\Domain\Service\ServiceInterface;
use PlanB\DS\ItemList\ItemList;

/**
 * La configuración de un servicio
 */
class Service
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var \PlanB\DS\ItemList\ItemList
     */
    private $params;

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
            'class' => null,
        ], $values);

        return array_to_object($values, new static());
    }

    /**
     * Service constructor.
     */
    private function __construct()
    {
        $this->params = ItemList::create();
    }

    /**
     * Devuelve el nombre de la clase
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Asigna el nombre de la clase
     *
     * @param string $class
     *
     * @return \Alfred\Core\Domain\Configuration\Service
     */
    public function setClass(string $class): Service
    {
        ensure_typename($class)
            ->isChildOf(ServiceInterface::class);

        $this->class = $class;

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
     * @return \Alfred\Core\Domain\Configuration\Service
     */
    public function setParams(array $params): Service
    {
        $this->params->clearAndSet($params);

        return $this;
    }
}
