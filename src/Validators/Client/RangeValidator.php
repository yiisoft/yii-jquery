<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * RangeValidator composes client-side validation code from [[\yii\validators\RangeValidator]].
 *
 * @see \yii\validators\RangeValidator
 * @see ValidationAsset
 */
class RangeValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        /* @var $validator \yii\validators\RangeValidator */
        if ($validator->range instanceof \Closure) {
            $validator->range = ($validator->range)($model, $attribute);
        }

        ValidationAsset::register($view);

        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.range(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\RangeValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $range = [];

        foreach ($validator->range as $value) {
            $range[] = (string) $value;
        }

        $options = [
            'range' => $range,
            'not' => $validator->not,
            'message' => $validator->formatMessage($validator->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ]),
        ];

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        if ($validator->allowArray) {
            $options['allowArray'] = 1;
        }

        return $options;
    }
}
