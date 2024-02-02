<?php

use Spiral\Twig\TwigEngine;

return [
    'cache' => [
        'enabled' => !env('DEBUG', false),
        'directory' => directory('cache') . 'views'
    ],
    'namespaces' => [
        'default' => [
            directory('views')
        ]
    ],
    'dependencies' => [],
    'engines' => [
        TwigEngine::class
    ],
    'globalVariables' => [
        'some_var' => env('SOME_VALUE')
    ]
];
