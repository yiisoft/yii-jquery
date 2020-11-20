<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use yii\web\JsExpression;
use Yiisoft\Html\Html;
use Yiisoft\Json\Json;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * RegularExpressionValidator composes client-side validation code from [[\yii\validators\RegularExpressionValidator]].
 *
 * @see \yii\validators\RegularExpressionValidator
 * @see ValidationAsset
 */
class RegularExpressionValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.regularExpression(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\RegularExpressionValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $pattern = Html::escapeJsRegularExpression($validator->pattern);

        $options = [
            'pattern' => new JsExpression($pattern),
            'not' => $validator->not,
            'message' => $validator->formatMessage($validator->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ]),
        ];

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        return $options;
    }
}
