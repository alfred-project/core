<?php

namespace spec\Alfred\Core\Domain\Configuration;

use Alfred\Core\Domain\Configuration\Config;
use Alfred\Core\Domain\Configuration\ServiceList;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Yaml\Yaml;

class ConfigSpec extends ObjectBehavior
{
    public function let()
    {
        $path = sprintf('%s/files/config.yml', __DIR__);
        $values = Yaml::parseFile($path);
        $this->beConstructedThrough('fromArray', [$values]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Config::class);
    }

    public function it_can_hydrate_services_from_array()
    {
        $this->getServices()->count()->shouldReturn(2);
        $this->getServices()->has('readme')->shouldReturn(true);
        $this->getServices()->has('license')->shouldReturn(true);

    }

    public function it_can_hydrate_profiles_from_array()
    {
        $this->getProfiles()->count()->shouldReturn(1);
        $this->getProfiles()->has('init')->shouldReturn(true);
    }


    public function it_can_hydrate_jobs_from_array()
    {
        $this->getJobs()->count()->shouldReturn(1);
        $this->getJobs()->has('init')->shouldReturn(true);
    }
}
