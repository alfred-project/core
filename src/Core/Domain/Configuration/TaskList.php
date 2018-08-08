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

use PlanB\DS\TypedList\AbstractTypedList;
use PlanB\Type\DataType\Type;

/**
 * Lista de tareas para un trabajo definida en la configuración
 */
class TaskList extends AbstractTypedList
{
    /**
     * Crea una instancia a partir de un conjunto de valores
     *
     * @param mixed[] $input
     *
     * @return \PlanB\DS\ItemList\ListInterface
     */
    public static function create(iterable $input = []): TaskList
    {
        $list = new static();
        $list->setAll($input);

        return $list;
    }
    /**
     * Devuelve el tipo de la lista
     *
     * @return string
     */
    public function getInnerType(): string
    {
        return Task::class;
    }

    /**
     * Configura el comportamiento de  la lista
     *
     * @return void
     */
    protected function customize(): void
    {
        $this->addHydrator(Type::ARRAY, function (array $value) {
            return Task::fromArray($value);
        });
    }
}
