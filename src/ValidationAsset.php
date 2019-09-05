<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Asset\AssetBundle;

/**
 * This asset bundle provides the javascript files for client validation.
 *
 * ValidationAsset.
 */
class ValidationAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = __DIR__ . '/assets';

    /**
     * {@inheritdoc}
     */
    public $js = ['yii.validation.js'];

    /**
     * {@inheritdoc}
     */
    public $depends = [YiiAsset::class];
}
