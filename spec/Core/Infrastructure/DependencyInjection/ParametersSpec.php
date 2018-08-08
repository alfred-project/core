<?php

namespace spec\Alfred\Core\Infrastructure\DependencyInjection;

use Alfred\Core\Infrastructure\DependencyInjection\Parameters;
use PhpSpec\ObjectBehavior;
use PlanB\Type\Assurance\Exception\AssertException;
use PlanB\Type\Path\Exception\InvalidPathException;
use PlanB\Type\Path\Path;
use Prophecy\Argument;

class ParametersSpec extends ObjectBehavior
{

    public function let()
    {
        $this->beConstructedThrough('fromArray');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Parameters::class);
    }

    public function it_has_a_project_dir_by_default()
    {
        $this->getProjectDir()
            ->shouldReturn(getcwd());
    }

    public function it_retrive_a_custom_project_dir()
    {
        $this->beConstructedThrough('fromArray', [[
            'project-dir' => __DIR__
        ]]);

        $this->getProjectDir()
            ->shouldReturn(__DIR__);
    }

    public function it_throw_an_exception_when_project_dir_dont_exists()
    {
        $this->beConstructedThrough('fromArray', [[
            'project-dir' => '/fake/directory'
        ]]);

        $this->shouldThrow(AssertException::class)->duringInstantiation();
    }

    public function it_has_a_config_file_by_default()
    {
        $expected = sprintf('%s/%s/%s', ...[
                getcwd(),
                Parameters::DEFAULT_CONFIG_DIRECTORY,
                Parameters::DEFAULT_CONFIG_FILENAME
            ]
        );

        $this->getConfigFile()
            ->shouldReturn($expected);
    }

    public function it_retrive_a_custom_config_file()
    {
        $custom = Path::normalize(__DIR__, 'dummies/custom-config-file.yml');
        $this->beConstructedThrough('fromArray', [[
            'config-file' => $custom
        ]]);

        $this->getConfigFile()
            ->shouldReturn($custom);
    }


    public function it_retrive_a_default_config_file_relative_to_project_dir()
    {

        $custom = Path::normalize(__DIR__, 'dummies', '.alfred/config.yml');

        $this->beConstructedThrough('fromArray', [[
            'project-dir' => sprintf('%s/%s', __DIR__, 'dummies')
        ]]);

        $this->getConfigFile()
            ->shouldReturn($custom);
    }

    public function it_retrive_a_normalized_custom_config_file()
    {
        $custom = sprintf('%s/%s', __DIR__, '/dummies/../dummies/custom-config-file.yml');
        $expected = sprintf('%s/%s', __DIR__, 'dummies/custom-config-file.yml');

        $this->beConstructedThrough('fromArray', [[
            'config-file' => $custom
        ]]);

        $this->getConfigFile()
            ->shouldReturn($expected);
    }

    public function it_throw_an_exception_when_config_file_dont_exists()
    {
        $this->beConstructedThrough('fromArray', [[
            'config-file' => '/fake/config/file'
        ]]);

        $this->shouldThrow(AssertException::class)->duringInstantiation();
    }

    public function it_throw_an_exception_when_config_file_havent_yml_extension()
    {
        $this->beConstructedThrough('fromArray', [[
            'config-file' => __FILE__
        ]]);

        $this->shouldThrow(AssertException::class)->duringInstantiation();
    }

    public function it_can_be_converted_to_iterator()
    {
        $custom = sprintf('%s/%s', __DIR__, '/dummies/../dummies/custom-config-file.yml');
        $this->beConstructedThrough('fromArray', [[
            'config_file' => $custom
        ]]);

        $this->getIterator()->shouldIterateAs([
            "project-dir" => getcwd(),
            "config-file" => Path::normalize($custom)
        ]);
    }

}
