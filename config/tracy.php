<?php

return [
    'enabled' => env('APP_DEBUG'),
    'showBar' => env('APP_DEBUG'),
    'showException' => false,
    'route' => [
        'prefix' => 'tracy',
        'as' => 'tracy.',
    ],
    'accepts' => [
        'text/html',
    ],
    'appendTo' => 'body',
    'editor' => 'phpstorm://open?file=%file&line=%line',
    'maxDepth' => 4,
    'maxLength' => 1000,
    'scream' => true,
    'showLocation' => true,
    'strictMode' => true,
    'editorMapping' => [],
    'panels' => [
        'routing' => true,
        'database' => true,
        'view' => true,
        'event' => false,
        'session' => true,
        'request' => true,
        'auth' => true,
        'html-validator' => false,
        'terminal' => true,
    ],
];
