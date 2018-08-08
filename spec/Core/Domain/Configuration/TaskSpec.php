<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Task;
use PhpSpec\ObjectBehavior;
use PlanB\Type\Assurance\Exception\AssertException;
use Prophecy\Argument;

class TaskSpec extends ObjectBehavior
{

    private const SERVICE = 'service-a';

    private const ACTION = 'action-A';

    private const PARAMS = [
        'A' => 'param-A',
        'B' => 'param-B',
        'C' => 'param-C',
    ];

    private const VALUES = [
        'service' => self::SERVICE,
        'action' => self::ACTION,
        'params' => self::PARAMS
    ];


    private const BLANK = ' ';

    public function let()
    {
        $this->beConstructedThrough('fromArray', [self::VALUES]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Task::class);
    }

    public function it_create_from_array()
    {
        $this->getService()->shouldReturn(self::SERVICE);
        $this->getAction()->shouldReturn(self::ACTION);
        $this->getParams()->toArray()->shouldIterateAs(self::PARAMS);
    }

    public function it_create_from_array_without_action()
    {
        $values = self::VALUES;
        unset($values['action']);

        $this->beConstructedThrough('fromArray', [$values]);

        $this->getService()->shouldReturn(self::SERVICE);
        $this->getAction()->shouldReturn(null);
        $this->getParams()->toArray()->shouldIterateAs(self::PARAMS);
    }

    public function it_cannt_set_blank_service()
    {
        $this->shouldThrow(AssertException::class)->duringSetService(self::BLANK);
    }

    public function it_cannt_set_blank_action()
    {
        $this->shouldThrow(AssertException::class)->duringSetAction(self::BLANK);
    }
}
