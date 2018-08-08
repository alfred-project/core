<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Profile;
use Alfred\Core\Domain\Configuration\ProfileList;
use PhpSpec\ObjectBehavior;
use PlanB\DS\ItemList\Typed;
use PlanB\DS\ItemList\TypedList;
use PlanB\DS\TypedList\AbstractTypedList;
use Prophecy\Argument;

class ProfileListSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('create');
    }


    public function it_is_initializable()
    {
        $this->shouldHaveType(ProfileList::class);
    }

    public function it_is_typed_list()
    {
        $this->shouldHaveType(AbstractTypedList::class);
    }


    public function it_has_valid_type()
    {
        $this->getInnerType()
            ->shouldReturn(Profile::class);
    }
}
