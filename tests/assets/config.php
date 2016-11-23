<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driver_class' => Doctrine\DBAL\Driver\PDOSqlite\Driver::class,
                'params' => [
                    [
                        'url' => 'sqlite:///:memory:',
                        'memory' => true
                    ]
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => __DIR__ . '/doctrine',
            ],
        ],
    ],
];