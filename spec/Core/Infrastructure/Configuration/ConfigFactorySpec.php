<?php

namespace spec\Alfred\Core\Infrastructure\Configuration;

use Alfred\Core\Domain\Configuration\Config;
use Alfred\Core\Infrastructure\Configuration\ConfigFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class ConfigFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ConfigFactory::class);
    }

    public function it_can_create_a_config_from_a_yml_file()
    {
        $configPath = sprintf('%s/files/config.yml', __DIR__);
        $this->create($configPath)->shouldHaveType(Config::class);
    }

    public function it_can_create_a_config_from_a_yaml_file()
    {
        $configPath = sprintf('%s/files/config.yaml', __DIR__);
        $this->create($configPath)->shouldHaveType(Config::class);
    }

    public function it_can_create_an_empty_config()
    {

        $custom = [];

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('services', []);

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('profiles', []);

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('jobs', []);

    }

    public function it_can_create_a_config_with_services()
    {

        $custom = [
            'services' => [
                'service_A' => [
                    'class' => __CLASS__
                ]
            ]
        ];

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('services', [
                'service_A' => [
                    'class' => __CLASS__,
                    'params' => []
                ]
            ]);
    }

    public function it_fail_when_try_add_a_service_without_class()
    {
        $custom = [
            'services' => [
                'service_A' => []
            ]
        ];

        $this->shouldThrow(InvalidConfigurationException::class)->duringProcessConfig($custom);
    }


    public function it_can_create_a_config_with_profiles()
    {

        $custom = [
            'profiles' => [
                'profile_A' => [
                    'description' => 'descripción del perfil'
                ]
            ]
        ];

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('profiles', [
                'profile_A' => [
                    'description' => 'descripción del perfil',
                    'jobs' => []
                ]
            ]);
    }

    public function it_fail_when_try_add_a_profile_without_description()
    {
        $custom = [
            'profiles' => [
                'profile_A' => [
                    'description' => '',
                ]
            ]
        ];

        $this->shouldThrow(InvalidConfigurationException::class)->duringProcessConfig($custom);
    }

    public function it_can_create_a_config_with_jobs()
    {
        $custom = [
            'jobs' => [
                'job_A' => [
                ]
            ]
        ];

        $this->processConfig($custom)
            ->shouldHaveKeyWithValue('jobs', [
                'job_A' => [
                    'stop_on_fail' => false,
                    'async' => false,
                    'tasks' => []
                ]
            ]);
    }


    public function it_fail_when_try_add_a_task_without_service()
    {
        $custom = [
            'jobs' => [
                'job_A' => [
                    'tasks' => [
                        'task_A' => [
                            'action' => 'init'
                        ]
                    ]
                ]
            ]
        ];

        $this->shouldThrow(InvalidConfigurationException::class)->duringProcessConfig($custom);
    }

}
