<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery\Tests;

use Yii;
use yii\data\ArrayDataProvider;
use yii\dataview\GridView;
use Yiisoft\Yii\JQuery\GridViewAsset;
use Yiisoft\Yii\JQuery\GridViewClientScript;
use yii\web\View;

/**
 * @group widget
 */
class GridViewClientScriptTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        // dirty way to have Request object not throwing exception when running testHomeLinkNull()
        $_SERVER['SCRIPT_FILENAME'] = "index.php";
        $_SERVER['SCRIPT_NAME'] = "index.php";

        $this->mockWebApplication();
        $this->container->set('assetManager', [
            '__class' => \yii\web\AssetManager::class,
            'bundles' => [
                GridViewAsset::class => [
                    'sourcePath' => null,
                    'basePath' => null,
                    'baseUrl' => 'http://example.com/assets',
                    'depends' => [],
                ],
            ],
        ]);
    }

    public function testRegisterClientScript()
    {
        $row = ['id' => 1, 'name' => 'Name1', 'value' => 'Value1', 'description' => 'Description1',];

        $dp = new ArrayDataProvider();
        $dp->allModels = [
            $row,
        ];

        GridView::widget([
            'id' => 'test-grid',
            'dataProvider' => $dp,
            'filterUrl' => 'http://example.com/filter',
            'as clientScript' => [
                '__class' => GridViewClientScript::class
            ],
        ]);

        $this->assertTrue($this->app->assetManager->bundles[GridViewAsset::class] instanceof GridViewAsset);
        $this->assertNotEmpty($this->app->view->js[View::POS_END]);
        $js = end($this->app->view->js[View::POS_END]);
        $this->assertContains("jQuery('#test-grid').yiiGridView(", $js);
    }
}
