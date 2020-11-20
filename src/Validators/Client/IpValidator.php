<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery\Validators\Client;

use yii\validators\client\ClientValidator;
use yii\web\JsExpression;
use Yiisoft\Html\Html;
use Yiisoft\Json\Json;
use Yiisoft\Yii\JQuery\ValidationAsset;

/**
 * IpValidator composes client-side validation code from {@see \Yiisoft\Validator\Rule\Ip::class}.
 *
 * @see \Yiisoft\Validator\Rule\Ip::class
 * @see ValidationAsset
 */
class IpValidator extends ClientValidator
{
    /**
     * {@inheritdoc}
     */
    public function build($validator, $model, $attribute, $view)
    {
        ValidationAsset::register($view);
        $options = $this->getClientOptions($validator, $model, $attribute);

        return 'yii.validation.ip(value, messages, ' . Json::htmlEncode($options) . ');';
    }

    /**
     * Returns the client-side validation options.
     *
     * @param \yii\validators\IpValidator $validator the server-side validator.
     * @param \yii\base\Model $model the model being validated
     * @param string $attribute the attribute name being validated
     *
     * @return array the client-side validation options
     */
    public function getClientOptions($validator, $model, $attribute)
    {
        $messages = [
            'ipv6NotAllowed' => $validator->ipv6NotAllowed,
            'ipv4NotAllowed' => $validator->ipv4NotAllowed,
            'message' => $validator->message,
            'noSubnet' => $validator->noSubnet,
            'hasSubnet' => $validator->hasSubnet,
        ];

        foreach ($messages as &$message) {
            $message = $validator->formatMessage($message, [
                'attribute' => $model->getAttributeLabel($attribute),
            ]);
        }

        $options = [
            'ipv4Pattern' => new JsExpression(Html::escapeJsRegularExpression($validator->ipv4Pattern)),
            'ipv6Pattern' => new JsExpression(Html::escapeJsRegularExpression($validator->ipv6Pattern)),
            'messages' => $messages,
            'ipv4' => (bool) $validator->ipv4,
            'ipv6' => (bool) $validator->ipv6,
            'ipParsePattern' => new JsExpression(Html::escapeJsRegularExpression($validator->getIpParsePattern())),
            'negation' => $validator->negation,
            'subnet' => $validator->subnet,
        ];

        if ($validator->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        return $options;
    }
}
