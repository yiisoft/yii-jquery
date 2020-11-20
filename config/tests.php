<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;

return [
    Aliases::class => [
        '@root' => dirname(__DIR__, 1),
        '@public' => '@root/tests/public',
        '@basePath' => '@public/assets',
        '@baseUrl' => '/baseUrl',
        '@npm' => '@root/node_modules',
    ],
];
