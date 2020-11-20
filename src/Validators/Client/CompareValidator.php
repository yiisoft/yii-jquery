<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use Yiisoft\Html\Html;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * CompareValidator composes client-side validation code from {@see \Yiisoft\Validator\Rule\CompareTo}.
 *
 * @see \Yiisoft\Validator\Rule\CompareTo
 * @see ValidationAsset
 */
class CompareValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.compare(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\CompareValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $options = [
            'operator' => $validator->operator,
            'type' => $validator->type,
        ];

        if ($validator->compareValue !== null) {
            $options['compareValue'] = $validator->compareValue;
            $compareLabel = $compareValue = $compareValueOrAttribute = $validator->compareValue;
        } else {
            $compareAttribute = $validator->compareAttribute === null ? $attribute . '_repeat' : $validator->compareAttribute;
            $compareValue = $model->getAttributeLabel($compareAttribute);
            $options['compareAttribute'] = Html::getInputId($model, $compareAttribute);
            $compareLabel = $compareValueOrAttribute = $model->getAttributeLabel($compareAttribute);
        }

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        $options['message'] = $validator->formatMessage($validator->message, [
            'attribute' => $model->getAttributeLabel($attribute),
            'compareAttribute' => $compareLabel,
            'compareValue' => $compareValue,
            'compareValueOrAttribute' => $compareValueOrAttribute,
        ]);

        return $options;
    }
}
