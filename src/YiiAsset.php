<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Assets\AssetBundle;

/**
 * This asset bundle provides the base JavaScript files for the Yii Framework.
 *
 * YiiAsset.
 */
class YiiAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';

    public ?string $baseUrl = '@baseUrl';

    public ?string $sourcePath = __DIR__ . '/assets';

    public array $js = ['yii.js'];

    public array $depends = [JqueryAsset::class];
}
