<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery\Tests\Validators;

use Yiisoft\Yii\JQuery\Validators\Client\NumberValidator;
use yii\web\View;
use Yiisoft\Yii\JQuery\Tests\Data\FakedValidationModel;
use Yiisoft\Yii\JQuery\Tests\TestCase;
use yii\view\Theme;

/**
 * @group validators
 */
class NumberValidatorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
    }
    /**
     * @see https://github.com/yiisoft/yii2/issues/3118
     */
    public function testBuild()
    {
        $view = new View($this->app, new Theme());
        $view->assetBundles = [\Yiisoft\Yii\JQuery\ValidationAsset::class => true];
        $clientValidator = new NumberValidator();
        $model = new FakedValidationModel();

        $js = $clientValidator->build(
            new \yii\validators\NumberValidator([
                'min' => 5,
                'max' => 10,
            ]),
            $model,
            'attr_number',
            $view
        );
        $this->assertContains('"min":5', $js);
        $this->assertContains('"max":10', $js);

        $js = $clientValidator->build(
            new \yii\validators\NumberValidator([
                'min' => '5',
                'max' => '10',
            ]),
            $model,
            'attr_number',
            $view
        );
        $this->assertContains('"min":5', $js);
        $this->assertContains('"max":10', $js);

        $js = $clientValidator->build(
            new \yii\validators\NumberValidator([
                'min' => 5.65,
                'max' => 13.37,
            ]),
            $model,
            'attr_number',
            $view
        );
        $this->assertContains('"min":5.65', $js);
        $this->assertContains('"max":13.37', $js);

        $js = $clientValidator->build(
            new \yii\validators\NumberValidator([
                'min' => '5.65',
                'max' => '13.37',
            ]),
            $model,
            'attr_number',
            $view
        );
        $this->assertContains('"min":5.65', $js);
        $this->assertContains('"max":13.37', $js);
    }
}
