<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Yii\JQuery;

use Yii;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/**
 * ActiveFormClientScript is a behavior for [[\yii\widgets\ActiveForm]], which allows composition
 * of the client-side and AJAX form validation via underlying JQuery plugin.
 *
 * Usage example:
 *
 * ```php
 * <?php $form = \yii\widgets\ActiveForm::begin([
 *     'id' => 'example-form',
 *     'as clientScript' => \Yiisoft\Yii\JQuery\ActiveFormClientScript::class,
 *     // ...
 * ]); ?>
 * ...
 * <?php \yii\widgets\ActiveForm::end(); ?>
 * ```
 *
 * @see \yii\widgets\ActiveForm
 * @see \yii\widgets\ActiveFormClientScriptBehavior
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 1.0
 */
class ActiveFormClientScript extends \yii\widgets\ActiveFormClientScript
{
    /**
     * {@inheritdoc}
     */
    protected function defaultClientValidatorMap()
    {
        return [
            \yii\validators\BooleanValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\BooleanValidator::class,
            \yii\validators\CompareValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\CompareValidator::class,
            \yii\validators\EmailValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\EmailValidator::class,
            \yii\validators\FilterValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\FilterValidator::class,
            \yii\validators\IpValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\IpValidator::class,
            \yii\validators\NumberValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\NumberValidator::class,
            \yii\validators\RangeValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\RangeValidator::class,
            \yii\validators\RegularExpressionValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\RegularExpressionValidator::class,
            \yii\validators\RequiredValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\RequiredValidator::class,
            \yii\validators\StringValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\StringValidator::class,
            \yii\validators\UrlValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\UrlValidator::class,
            \yii\validators\ImageValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\ImageValidator::class,
            \yii\validators\FileValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\FileValidator::class,
            \Yiisoft\Yii\Captcha\CaptchaValidator::class => \Yiisoft\Yii\JQuery\Validators\Client\CaptchaClientValidator::class,
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
        $view = $this->owner->getView();
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
