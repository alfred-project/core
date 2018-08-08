<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Profile;
use PhpSpec\ObjectBehavior;
use PlanB\DS\Collection\Collection;
use PlanB\DS\ItemList\Exception\InvalidItemException;
use PlanB\DS\ItemResolver\Exception\InvalidValueTypeException;
use PlanB\Type\Text\TextList;

class ProfileSpec extends ObjectBehavior
{
    private const DESCRIPTION = 'descripcción del profile';
    private const NO_STRING = ['deberia' => 'ser un array'];

    public function let()
    {
        $this->beConstructedThrough('fromArray', [[
            'description' => self::DESCRIPTION
        ]]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Profile::class);

        $this->getDescription()
            ->shouldReturn(self::DESCRIPTION);

        $this->getJobs()
            ->shouldHaveType(TextList::class);
    }

    public function it_throw_an_exception_on_empty_description()
    {
        $this->beConstructedThrough('fromArray', [[]]);


        //   $this->shouldThrow(\TypeError::class)->duringInstantiation();
    }

    public function it_throw_an_exception_on_no_string_jobs()
    {
        $this->beConstructedThrough('fromArray', [[
            'description' => self::DESCRIPTION,
            'jobs' => [
                self::NO_STRING
            ]
        ]]);

        $this->shouldThrow(InvalidItemException::class)->duringInstantiation();
    }


}
