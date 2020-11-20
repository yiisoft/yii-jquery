<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use yii\web\JsExpression;
use Yiisoft\Json\Json;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * NumberValidator composes client-side validation code from {@see \Yiisoft\Validator\Rule\Number::class}.
 *
 * @see \Yiisoft\Validator\Rule\Number::class
 * @see ValidationAsset
 */
class NumberValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.number(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\NumberValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $label = $model->getAttributeLabel($attribute);

        $options = [
            'pattern' => new JsExpression($validator->integerOnly ? $validator->integerPattern : $validator->numberPattern),
            'message' => $validator->formatMessage($validator->message, [
                'attribute' => $label,
            ]),
        ];

        if ($validator->min !== null) {
            // ensure numeric value to make javascript comparison equal to PHP comparison
            // https://github.com/yiisoft/yii2/issues/3118
            $options['min'] = is_string($validator->min) ? (float) $validator->min : $validator->min;
            $options['tooSmall'] = $validator->formatMessage($validator->tooSmall, [
                'attribute' => $label,
                'min' => $validator->min,
            ]);
        }

        if ($validator->max !== null) {
            // ensure numeric value to make javascript comparison equal to PHP comparison
            // https://github.com/yiisoft/yii2/issues/3118
            $options['max'] = is_string($validator->max) ? (float) $validator->max : $validator->max;
            $options['tooBig'] = $validator->formatMessage($validator->tooBig, [
                'attribute' => $label,
                'max' => $validator->max,
            ]);
        }

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        return $options;
    }
}
