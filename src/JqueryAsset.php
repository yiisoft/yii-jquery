<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Asset\AssetBundle;

/**
 * This asset bundle provides the [jQuery](http://jquery.com/) JavaScript library.
 *
 * JqueryAsset.
 */
class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@npm/jquery/dist';
    public $js = [
        'jquery.js',
    ];
}
