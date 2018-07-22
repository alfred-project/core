<?php

namespace spec\Alfred\Core\Infrastructure\Configuration;

use Alfred\Core\Infrastructure\Configuration\Definition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class DefinitionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Definition::class);
    }

    public function it_build_config_tree()
    {
        $treeBuilder = $this->getConfigTreeBuilder();

        $treeBuilder->shouldHaveType(TreeBuilder::class);
    }
}
