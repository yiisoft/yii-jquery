<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use Yiisoft\Json\Json;
use Yiisoft\Widgets\ActiveForm;

/**
 * ActiveFormClientScript is a behavior for {@see \Yiisoft\Widgets\ActiveForm}, which allows composition
 * of the client-side and AJAX form validation via underlying JQuery plugin.
 *
 * Usage example:
 *
 * ```php
 * <?php $form = \Yiisoft\Widgets\ActiveForm::begin()
 *     ->options(['id' => 'example-form')
 *     ->asClientScript(\Yiisoft\Yii\JQuery\ActiveFormClientScript::class); ?>
 * ...
 * <?php \Yiisoft\Widgets\ActiveForm::end(); ?>
 * ```
 */
class ActiveFormClientScript extends \Yiisoft\Widgets\ActiveFormClientScript
{
    /**
     * {@inheritdoc}
     */
    protected function defaultClientValidatorMap()
    {
        return [
            \Yiisoft\Validator\Rule\Boolean::class => \Yiisoft\Yii\JQuery\Validators\Client\BooleanValidator::class,
            \Yiisoft\Validator\Rule\CompareTo::class => \Yiisoft\Yii\JQuery\Validators\Client\CompareValidator::class,
            \Yiisoft\Validator\Rule\Email::class => \Yiisoft\Yii\JQuery\Validators\Client\EmailValidator::class,
            \Yiisoft\Validator\Rule\Ip::class => \Yiisoft\Yii\JQuery\Validators\Client\IpValidator::class,
            \Yiisoft\Validator\Rule\Number::class => \Yiisoft\Yii\JQuery\Validators\Client\NumberValidator::class,
            \Yiisoft\Validator\Rule\Required::class => \Yiisoft\Yii\JQuery\Validators\Client\RequiredValidator::class,
            \Yiisoft\Validator\Rule\Url::class => \Yiisoft\Yii\JQuery\Validators\Client\UrlValidator::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function registerClientScript()
    {
        $id = $this->owner->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $attributes = Json::htmlEncode($this->attributes);

        ActiveFormAsset::register($view);

        $view->registerJs("jQuery('#$id').yiiActiveForm($attributes, $options);");
    }

    /**
     * {@inheritdoc}
     */
    protected function getFieldClientOptions($field)
    {
        $options = parent::getFieldClientOptions($field);

        // only get the options that are different from the default ones (set in yii.activeForm.js)
        return array_diff_assoc($options, [
            'validateOnChange' => true,
            'validateOnBlur' => true,
            'validateOnType' => false,
            'validationDelay' => 500,
            'encodeError' => true,
            'error' => '.help-block',
            'updateAriaInvalid' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getClientOptions()
    {
        $options = parent::getClientOptions();

        // only get the options that are different from the default ones (set in yii.activeForm.js)
        return array_diff_assoc($options, [
            'encodeErrorSummary' => true,
            'errorSummary' => '.error-summary',
            'validateOnSubmit' => true,
            'errorCssClass' => 'has-error',
            'successCssClass' => 'has-success',
            'validatingCssClass' => 'validating',
            'ajaxParam' => 'ajax',
            'ajaxDataType' => 'json',
            'scrollToError' => true,
            'scrollToErrorOffset' => 0,
            'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_CONTAINER,
        ]);
    }
}
