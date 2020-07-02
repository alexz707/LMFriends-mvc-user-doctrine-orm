<?php

declare(strict_types=1);

namespace LaminasFriends\Mvc\User\Doctrine\Orm;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use LaminasFriends\Mvc\User\Doctrine\Orm\Mapper\User;
use LaminasFriends\Mvc\User\Doctrine\Orm\Options\ModuleOptions as OrmModuleOptions;
use LaminasFriends\Mvc\User\Mapper\UserMapper;
use LaminasFriends\Mvc\User\Options\ModuleOptions;

class Module
{
    public function onBootstrap($e)
    {
        $app     = $e->getParam('application');
        $sm      = $app->getServiceManager();
        $options = $sm->get(ModuleOptions::class);

        // Add the default entity driver only if specified in configuration
        if ($options->getEnableDefaultEntities()) {
            $chain = $sm->get('doctrine.driver.orm_default');
            $chain->addDriver(new XmlDriver(__DIR__ . '/../config/xml/mvcuserdoctrineorm'), 'LaminasFriends\Mvc\User\Doctrine\Orm\Entity');
        }
    }

    public function getServiceConfig()
    {
        return [
            'aliases' => [
                'mvcuser_doctrine_em' => EntityManager::class,
            ],
            'factories' => [
                ModuleOptions::class => function ($sm) {
                    $config = $sm->get('Configuration');
                    return new OrmModuleOptions(isset($config['mvcuser']) ? $config['mvcuser'] : []);
                },
                UserMapper::class => function ($sm) {
                    return new User(
                        $sm->get('mvcuser_doctrine_em'),
                        $sm->get(ModuleOptions::class)
                    );
                },
            ],
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
