<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\jquery;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files needed for the [[EmailValidator]]s client validation.
 *
 * @see https://github.com/bestiejs/punycode.js/
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 1.0
 */
class PunycodeAsset extends AssetBundle
{
    public $sourcePath = '@npm/punycode';
    public $js = [
        'punycode.js',
    ];
}
