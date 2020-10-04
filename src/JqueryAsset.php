<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Assets\AssetBundle;

/**
 * This asset bundle provides the [jQuery](http://jquery.com/) JavaScript library.
 *
 * JqueryAsset.
 */
class JqueryAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';

    public ?string $baseUrl = '@baseUrl';

    public ?string $sourcePath = '@npm/jquery/dist';

    public array $js = [
        'jquery.js',
    ];
}
