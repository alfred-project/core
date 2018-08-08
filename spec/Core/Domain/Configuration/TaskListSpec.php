<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Task;
use Alfred\Core\Domain\Configuration\TaskList;
use PhpSpec\ObjectBehavior;

use PlanB\DS\TypedList\AbstractTypedList;
use Prophecy\Argument;

class TaskListSpec extends ObjectBehavior
{
    private const TASK = [
        'service' => 'service-A',
        'action' => 'action-A'
    ];

    public function let()
    {
        $this->beConstructedThrough('create');
    }


    public function it_is_initializable()
    {
        $this->shouldHaveType(TaskList::class);
    }

    public function it_is_typed_list()
    {
        $this->shouldHaveType(AbstractTypedList::class);
    }

    public function it_have_type_task()
    {
        $this->getInnerType()->shouldReturn(Task::class);
    }

    public function it_can_add_task_like_array()
    {
        $this->add(self::TASK)
            ->count()
            ->shouldReturn(1);
    }
}
