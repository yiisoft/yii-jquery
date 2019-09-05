<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Asset\AssetBundle;

/**
 * The asset bundle for the {@see ActiveForm} widget.
 *
 * ActiveFormAsset.
 */
class ActiveFormAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = __DIR__ . '/assets';

    /**
     * {@inheritdoc}
     */
    public $js = ['yii.activeForm.js'];

    /**
     * {@inheritdoc}
     */
    public $depends = [YiiAsset::class];
}
