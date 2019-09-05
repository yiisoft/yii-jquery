<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Asset\AssetBundle;

/**
 * This asset bundle provides the base JavaScript files for the Yii Framework.
 *
 * YiiAsset.
 */
class YiiAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = __DIR__ . '/assets';

    /**
     * {@inheritdoc}
     */
    public $js = ['yii.js'];

    /**
     * {@inheritdoc}
     */
    public $depends = [JqueryAsset::class];
}
