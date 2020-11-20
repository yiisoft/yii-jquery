<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * BooleanValidator composes client-side validation code from {@see Yiisoft\Validator\Rule\Boolean}.
 *
 * @see Yiisoft\Validator\Rule\Boolean
 * @see ValidationAsset
 */
class BooleanValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($validator, $model, $attribute);
        return 'yii.validation.boolean(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\BooleanValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $options = [
            'trueValue' => $validator->trueValue,
            'falseValue' => $validator->falseValue,
            'message' => $validator->formatMessage($validator->message, [
                'attribute' => $model->getAttributeLabel($attribute),
                'true' => $validator->trueValue === true ? 'true' : $validator->trueValue,
                'false' => $validator->falseValue === false ? 'false' : $validator->falseValue,
            ]),
        ];
        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }
        if ($validator->strict) {
            $options['strict'] = 1;
        }

        return $options;
    }
}
