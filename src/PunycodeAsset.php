<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Assets\AssetBundle;

/**
 * This asset bundle provides the javascript files needed for the {@see EmailValidator} client validation.
 *
 * @see https://github.com/bestiejs/punycode.js/
 *
 * PunycodeAsset.
 */
class PunycodeAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';

    public ?string $baseUrl = '@baseUrl';

    public ?string $sourcePath = '@npm/punycode';

    public array $js = [
        'punycode.js',
    ];
}
