<?php

declare(strict_types=1);

namespace Yiisoft\Assets\Tests;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Assets\Exception\InvalidConfigException;
use Yiisoft\Yii\JQuery\ActiveFormAsset;
use Yiisoft\Yii\JQuery\GridViewAsset;
use Yiisoft\Yii\JQuery\JqueryAsset;
use Yiisoft\Yii\JQuery\PunycodeAsset;
use Yiisoft\Yii\JQuery\ValidationAsset;
use Yiisoft\Yii\JQuery\YiiAsset;
use Yiisoft\Yii\JQuery\Tests\TestCase;

/**
 * AssetsTest.
 */
final class AssetsTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeAssets('@basePath');
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [ActiveFormAsset::class],
            [GridViewAsset::class],
            [JqueryAsset::class],
            [PunycodeAsset::class],
            [ValidationAsset::class],
            [YiiAsset::class],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $bundleClass
     */
    public function testAssetsPublish(string $bundleClass): void
    {
        $bundle = new $bundleClass();

        [$bundle->basePath, $bundle->baseUrl] = $this->assetManager->getPublish()->publish(
            $this->assetManager,
            $bundle
        );

        foreach ($bundle->js as $filename) {
            $publishedFile = $bundle->basePath . DIRECTORY_SEPARATOR . $filename;

            $this->assertFileExists($publishedFile);
        }

        $this->assertDirectoryExists(dirname($bundle->basePath . DIRECTORY_SEPARATOR . $bundle->js[0]));
        $this->assertDirectoryExists($bundle->basePath);
    }
}
