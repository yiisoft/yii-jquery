<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for client validation.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 1.0
 */
class ValidationAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@Yiisoft/Yii/JQuery/assets';
    /**
     * {@inheritdoc}
     */
    public $js = ['yii.validation.js'];
    /**
     * {@inheritdoc}
     */
    public $depends = [YiiAsset::class];
}
