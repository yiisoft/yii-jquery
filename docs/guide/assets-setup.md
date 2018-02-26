Assets Setup
============

This extensions relies on [NPM](https://www.npmjs.org/) packages for the asset installation.
Before using this package you should decide in which way you will install those packages in your project.


## Using asset-packagist repository

You can setup [asset-packagist.org](https://asset-packagist.org) as package source for the JQuery assets.

In the `composer.json` of your project, add the following lines:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Adjust `@npm` alias in you application configuration:

```php
return [
    //...
    'aliases' => [
        '@npm'   => '@vendor/npm-asset',
    ],
    //...
];
```


## Using composer asset plugin

Install [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) globally, using following command:

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Add the following lines to `composer.json` of your project to adjust directories where the installed packages
will be placed, if you want to publish them using Yii:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm"
    }
}
```

Then you can run composer install/update command to pick up JQuery assets.

> Note: `fxp/composer-asset-plugin` significantly slows down the `composer update` command in comparison
  to asset-packagist.


## Using Bower/NPM client directly

You can install JQuery UI assets directly via NPM client.
In the `package.json` of your project, add the following lines:

```json
{
    ...
    "dependencies": {
        "jquery": "3.2.0",
        "punycode": "1.3.0",
        ...
    }
    ...
}
```

In the `composer.json` of your project, add the following lines in order to prevent redundant JQuery UI asset installation:

```json
"replace": {
    "npm-asset/jquery": ">=3.2.0",
    "npm-asset/punycode": ">=1.3.0"
},
```


## Using CDN

You may use JQuery assets from [official CDN](https://code.jquery.com/).

In the `composer.json` of your project, add the following lines in order to prevent redundant JQuery asset installation:

```json
"replace": {
    "npm-asset/jquery": ">=3.2.0",
    "npm-asset/punycode": ">=1.3.0"
},
```

Configure 'assetManager' application component, overriding JQuery assent bundles with CDN links:

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                yii\jquery\JqueryAsset::class => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://code.jquery.com',
                    'js' => [
                        'jquery-3.3.1.min.js'
                    ],
                ],
                yii\jquery\PunycodeAsset::class => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://code.jquery.com/ui/1.12.1',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
