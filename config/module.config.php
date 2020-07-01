<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Driver\XmlDriver;

return [
    'doctrine' => [
        'driver' => [
            'mvcuser_entity' => [
                'class' => XmlDriver::class,
                'paths' => __DIR__ . '/xml/mvcuser'
            ],

            'orm_default' => [
                'drivers' => [
                    'LaminasFriends\Mvc\User\Entity'  => 'mvcuser_entity'
                ]
            ]
        ]
    ],
];
