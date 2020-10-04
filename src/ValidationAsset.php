<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Assets\AssetBundle;

/**
 * This asset bundle provides the javascript files for client validation.
 *
 * ValidationAsset.
 */
class ValidationAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';

    public ?string $baseUrl = '@baseUrl';

    public ?string $sourcePath = __DIR__ . '/assets';

    public array $js = ['yii.validation.js'];

    public array $depends = [YiiAsset::class];
}
