<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Job;
use Alfred\Core\Domain\Configuration\TaskList;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JobSpec extends ObjectBehavior
{
    private const EMPTY_VALUES = [];
    private const VALUES = [
        'stop_on_fail' => true,
        'async' => true,
        'tasks' => self::TASKS
    ];
    private const TASKS = [
        [
            'service' => 'service-A',
            'action' => 'action-A'
        ],
        [
            'service' => 'service-B',
            'action' => 'action-B'
        ]
    ];

    public function let()
    {
        $this->beConstructedThrough('fromArray', [self::EMPTY_VALUES]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Job::class);
    }

    public function it_have_stop_on_failure_value_by_default()
    {
        $this->isStopOnFail()->shouldReturn(false);
    }

    public function it_can_set_stop_on_failure_value()
    {
        $this->setStopOnFail(true)
            ->isStopOnFail()->shouldReturn(true);
    }

    public function it_have_async_value_by_default()
    {
        $this->isAsync()->shouldReturn(false);
    }

    public function it_can_set_async_value()
    {
        $this->setAsync(true)
            ->isAsync()->shouldReturn(true);
    }

    public function it_have_tasks_value_by_default()
    {
        $this->getTasks()->shouldHaveType(TaskList::class);
        $this->getTasks()->isEmpty()->shouldReturn(true);
    }

    public function it_can_set_tasks_value()
    {

        $this->setTasks(self::TASKS);

        $this->getTasks()->shouldHaveType(TaskList::class);
        $this->getTasks()->count()->shouldReturn(2);
    }


    public function it_can_create_from_array()
    {
        $this->beConstructedThrough('fromArray', [self::VALUES]);

        $this->isStopOnFail()->shouldReturn(true);
        $this->isAsync()->shouldReturn(true);

        $this->getTasks()->shouldHaveType(TaskList::class);
        $this->getTasks()->count()->shouldReturn(2);
    }
}
