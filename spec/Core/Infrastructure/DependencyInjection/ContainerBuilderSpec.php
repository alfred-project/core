<?php

namespace spec\Alfred\Core\Infrastructure\DependencyInjection;

use Alfred\Core\Infrastructure\DependencyInjection\ContainerBuilder;
use Alfred\Core\Infrastructure\DependencyInjection\Parameters;
use Alfred\Core\UI\Console\ParameterResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\ArgvInput;

class ContainerBuilderSpec extends ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType(ContainerBuilder::class);
    }

    public function it_has_a_parameter_called_project_dir_by_default()
    {
        $this->build();
        $this->getParameter('project-dir')->shouldBe(getcwd());
    }

    public function it_has_a_custom_parameter_called_project_dir()
    {
        $this->build([
            'project_dir' => __DIR__,
        ]);
        $this->getParameter('project-dir')->shouldBe(__DIR__);
    }

    public function it_has_a_parameter_called_config_file_by_default()
    {
        $this->build();
        $expected = sprintf('%s/.alfred/config.yml', getcwd());

        $this->getParameter('config-file')->shouldBe($expected);
    }

    public function build(array $values = [])
    {
        $default = [
            'project_dir' => getcwd(),
            'config_file' => sprintf('%s/.alfred/config.yml', getcwd())
        ];

        $values = array_replace($default, $values);

        $parameters = Parameters::fromArray($values);

        $this->beConstructedThrough('create', [$parameters]);
    }


}
