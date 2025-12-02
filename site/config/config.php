<?php

use Kirby\Cms\App;
use Kirby\Cms\Site;
use Kirby\Toolkit\Collection;

return [
    'debug' => true,
    'hooks' => [
        'file.create:before' => function ($file, $upload) {
            // Optional logic
        }
    ],
    'thumbs' => [
        'format' => 'webp',
        'presets' => [
            'sm' => ['width' => 400],
            'md' => ['width' => 800],
            'lg' => ['width' => 1200],
            'xl' => ['width' => 1800]
        ]
    ],
];
