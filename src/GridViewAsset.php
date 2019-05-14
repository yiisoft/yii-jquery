<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for the [[GridView]] widget.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 1.0
 */
class GridViewAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = __DIR__ . '/assets';
    /**
     * {@inheritdoc}
     */
    public $js = ['yii.gridView.js'];
    /**
     * {@inheritdoc}
     */
    public $depends = [YiiAsset::class];
}
