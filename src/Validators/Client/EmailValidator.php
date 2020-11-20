<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use yii\web\JsExpression;
use Yiisoft\Json\Json;
use Yiisoft\Yii\JQuery\PunycodeAsset;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * EmailValidator composes client-side validation code from {@see \Yiisoft\Validator\Rule\Email::class}.
 *
 * @see \yii\validators\EmailValidator
 * @see ValidationAsset
 */
class EmailValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        /* @var $validator \yii\validators\EmailValidator */
        ValidationAsset::register($view);

        if ($validator->enableIDN) {
            PunycodeAsset::register($view);
        }

        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.email(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\EmailValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $options = [
            'pattern' => new JsExpression($validator->pattern),
            'fullPattern' => new JsExpression($validator->fullPattern),
            'allowName' => $validator->allowName,
            'message' => $validator->formatMessage($validator->message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ]),
            'enableIDN' => (bool)$validator->enableIDN,
        ];

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        return $options;
    }
}
