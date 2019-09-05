<?php
declare(strict_types = 1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Asset\AssetBundle;

/**
 * This asset bundle provides the javascript files needed for the {@see EmailValidator} client validation.
 *
 * @see https://github.com/bestiejs/punycode.js/
 *
 * PunycodeAsset.
 */
class PunycodeAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@npm/punycode';

    /**
     * {@inheritdoc}
     */
    public $js = [
        'punycode.js',
    ];
}
