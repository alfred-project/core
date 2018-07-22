<?php

namespace spec\Alfred\Core\Infrastructure\Configuration;

use Alfred\Core\Domain\Configuration\Config;
use Alfred\Core\Infrastructure\Configuration\ConfigFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ConfigFactory::class);
    }

    public function it_can_create_a_config_from_a_filepath()
    {

        $configDir = sprintf('%s/files/complete', __DIR__);
        $this->create($configDir)->shouldHaveType(Config::class);
    }
}
