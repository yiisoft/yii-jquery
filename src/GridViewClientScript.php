<?php

declare(strict_types=1);

namespace Yiisoft\Yii\JQuery;

use yii\base\Behavior;
use yii\helpers\Url;
use yii\widgets\RunEvent;
use Yiisoft\Json\Json;
use Yiisoft\Widgets\Widget;

/**
 * GridViewClientScript is a behavior for {@see \Yiisoft\Yii\DataView\GridView} widget, which allows automatic filter
 * submission via jQuery component.
 *
 * A basic usage looks like the following:
 *
 * ```php
 * <?= \Yiisoft\Yii\DataView\GridView::widget()
 *     ->dataProvider($dataProvider)
 *     ->asClientScript([
 *         'class' => Yiisoft\Yii\JQuery\GridViewClientScript::class
 *     ])
 *     ->columns([
 *         'id',
 *         'name',
 *         'created_at:datetime',
 *         // ...
 * ]); ?>
 * ```
 *
 * @see \Yiisoft\Yii\DataView\GridView
 * @see GridViewAsset
 *
 * @property \Yiisoft\Yii\DataView\GridView $owner the owner of this behavior.
 */
class GridViewClientScript extends Behavior
{
    /**
     * @var string additional jQuery selector for selecting filter input fields.
     */
    public $filterSelector;

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            RunEvent::BEFORE => 'beforeRun',
        ];
    }

    /**
     * Handles {@see \Yiisoft\Widget\Widget::EVENT_BEFORE_RUN} event, registering related client script.
     *
     * @param \Yiisoft\Widget\Event\BeforeRun $event event instance.
     */
    public function beforeRun(BeforeRun $event)
    {
        $id = $this->owner->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->owner->getView();

        GridViewAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiGridView($options);");
    }

    /**
     * Returns the options for the grid view JS widget.
     *
     * @return array the options
     */
    protected function getClientOptions()
    {
        $filterUrl = $this->owner->filterUrl ?? Yii::getApp()->request->url;
        $id = $this->owner->filterRowOptions['id'];
        $filterSelector = "#$id input, #$id select";
        if (isset($this->filterSelector)) {
            $filterSelector .= ', ' . $this->filterSelector;
        }

        return [
            'filterUrl' => Url::to($filterUrl),
            'filterSelector' => $filterSelector,
        ];
    }
}
