<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Service;
use Alfred\Core\Domain\Service\File;
use PhpSpec\ObjectBehavior;
use PlanB\Type\Assurance\Exception\AssertException;
use Prophecy\Argument;


class ServiceSpec extends ObjectBehavior
{
    private const PARAMS = [
        'A' => 1,
        'B' => 2
    ];

    private const CLASSNAME = File::class;

    public function it_is_initializable()
    {
        $this->shouldHaveType(Service::class);
    }

    public function it_can_create_from_array()
    {
        $this->beConstructedThrough('fromArray', [[
            'class' => self::CLASSNAME,
            'params' => self::PARAMS
        ]]);

        $this->getClass()->shouldReturn(self::CLASSNAME);
        $this->getParams()->toArray()->shouldReturn(self::PARAMS);
    }

    public function it_returns_an_empty_list_by_default()
    {
        $this->beConstructedThrough('fromArray', [[
            'class' => self::CLASSNAME
        ]]);

        $this->getClass()->shouldReturn(self::CLASSNAME);
        $this->getParams()->isEmpty()->shouldReturn(true);
    }

    public function it_throws_an_exception_when_creates_with_an_invalid_class()
    {
        $this->beConstructedThrough('fromArray', [[
            'class' => __CLASS__
        ]]);

        $this->shouldThrow(AssertException::class)->duringInstantiation();
    }

}
