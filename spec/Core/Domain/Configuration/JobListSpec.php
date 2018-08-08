<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Job;
use Alfred\Core\Domain\Configuration\JobList;
use PhpSpec\ObjectBehavior;
use PlanB\DS\ItemList\Typed;
use PlanB\DS\ItemList\TypedList;
use PlanB\DS\TypedList\AbstractTypedList;
use Prophecy\Argument;

class JobListSpec extends ObjectBehavior
{
    public function let(){
        $this->beConstructedThrough('create');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(JobList::class);
    }

    public function it_is_typed_list()
    {
        $this->shouldHaveType(AbstractTypedList::class);
    }


    public function it_has_valid_type()
    {
        $this->getInnerType()
            ->shouldReturn(Job::class);
    }
}
