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
        $dummies = sprintf('%s/dummies', __DIR__);
        $this->build([
            'project_dir' => $dummies,
        ]);
        $this->getParameter('project-dir')->shouldBe($dummies);
    }

    public function it_has_a_parameter_called_config_file_by_default()
    {
        $this->build();
        $expected = sprintf('%s/.alfred/config.yml', getcwd());

        $this->getParameter('config-file')->shouldBe($expected);
    }

    public function it_has_a_parameter_called_config_file_by_default_over_project_dir()
    {
        $dummies = sprintf('%s/dummies', __DIR__);
        $this->build([
            'project_dir' => $dummies,
        ]);

        $expected = sprintf('%s/.alfred/config.yml', $dummies);

        $this->getParameter('config-file')->shouldBe($expected);
    }

    public function it_has_a_custom_parameter_called_config_file()
    {
        $file = sprintf('%s/dummies/.alfred/config.yml', __DIR__);
        $this->build([
            'config-file' => $file,
        ]);
        $this->getParameter('config-file')->shouldBe($file);
    }

    public function build(array $values = [])
    {
        $default = [
            'project_dir' => null,
            'config_file' => null
        ];

        $values = array_replace($default, $values);

        $parameters = Parameters::fromArray($values);

        $this->beConstructedThrough('create', [$parameters]);
    }


}
