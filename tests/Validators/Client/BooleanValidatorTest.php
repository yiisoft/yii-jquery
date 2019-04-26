<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery\Tests\Validators;

use Yiisoft\Yii\JQuery\Validators\Client\BooleanValidator;
use yii\web\View;
use Yiisoft\Yii\JQuery\Tests\Data\FakedValidationModel;
use Yiisoft\Yii\JQuery\Tests\TestCase;
use yii\view\Theme;

/**
 * @group validators
 */
class BooleanValidatorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
    }

    public function testBuild()
    {
        $validator = new \yii\validators\BooleanValidator([
            'trueValue' => true,
            'falseValue' => false,
            'strict' => true,
        ]);

        $clientValidator = new BooleanValidator();

        $model = new FakedValidationModel();
        $model->attrA = true;
        $model->attrB = '1';
        $model->attrC = '0';
        $model->attrD = [];

        $this->assertEquals(
            'yii.validation.boolean(value, messages, {"trueValue":true,"falseValue":false,"message":"attrB must be either \"true\" or \"false\".","skipOnEmpty":1,"strict":1});',
            $clientValidator->build($validator, $model, 'attrB', new ViewStub($this->app, new Theme()))
        );
    }
}

class ViewStub extends View
{
    public function registerAssetBundle($name, $position = null)
    {
    }
}
