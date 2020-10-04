<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Assets\AssetBundle;

/**
 * The asset bundle for the {@see ActiveForm} widget.
 *
 * ActiveFormAsset.
 */
class ActiveFormAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';

    public ?string $baseUrl = '@baseUrl';

    public ?string $sourcePath = __DIR__ . '/assets';

    public array $js = ['yii.activeForm.js'];

    public array $depends = [YiiAsset::class];
}
