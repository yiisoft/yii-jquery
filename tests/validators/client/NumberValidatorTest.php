<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\jquery\tests\validators;

use yii\jquery\validators\client\NumberValidator;
use yii\web\View;
use yii\jquery\tests\data\FakedValidationModel;
use yii\jquery\tests\TestCase;
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
        $view->assetBundles = [\yii\jquery\ValidationAsset::class => true];
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
