<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-sortable
 * @version 1.1.0
 */

namespace kartik\sortable;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Create sortable lists and grids using HTML5 drag and drop API for Yii 2.0.
 * Based on html5sortable plugin.
 *
 * @see http://farhadi.ir/projects/html5sortable/
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Sortable extends \kartik\base\Widget
{
    const TYPE_LIST = 'list';
    const TYPE_GRID = 'grid';

    /**
     * @var string the type of the sortable widget
     * Should be one of [[Sortable::TYPE]] constants.
     * Defaults to Sortable::TYPE_LIST
     */
    public $type = self::TYPE_LIST;

    /**
     * @var boolean, whether this widget is connected to another Sortable widget
     */
    public $connected = false;

    /**
     * @var boolean, whether this widget is disabled
     */
    public $disabled = false;

    /**
     * @var boolean, whether to show handle for each sortable item
     */
    public $showHandle = false;

    /**
     * @var string, the handle label, this is not HTML encoded
     */
    public $handleLabel = '<i class="glyphicon glyphicon-move"></i> ';

    /**
     * @var array the HTML attributes to be applied to all items.
     * This will be overridden by the [[options]] property within [[$items]].
     */
    public $itemOptions = [];

    /**
     * @var array the sortable items configuration for rendering elements within the sortable
     * list / grid. You can set the following properties:
     * - content: string, the list item content (this is not HTML encoded)
     * - disabled: bool, whether the list item is disabled
     * - options: array, the HTML attributes for the list item.
     */
    public $items = [];

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'sortable ' . $this->type);
        if ($this->connected) {
            Html::addCssClass($this->options, 'connected');
            $this->pluginOptions['connectWith'] = '.connected';
        }
        if ($this->showHandle) {
            $this->pluginOptions['handle'] = '.handle';
        }
        else {
            Html::addCssClass($this->options, 'cursor-move');
        }
        if ($this->hasDisabledItem() && empty($this->pluginOptions['items'])) {
            $this->pluginOptions['items'] = ':not(.disabled)';
        }
        $this->registerAssets();
        echo Html::beginTag('ul', $this->options);
    }

    /**
     * Runs the widget
     *
     * @return string|void
     */
    public function run()
    {
        echo $this->renderItems();
        echo Html::endTag('ul');
    }

    /**
     * Check if there is any disabled item
     *
     * @return bool
     */
    protected function hasDisabledItem()
    {
        foreach ($this->items as $item) {
            if (ArrayHelper::getValue($item, 'disabled', false)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Render the list items for the sortable widget
     *
     * @return string
     */
    protected function renderItems()
    {
        $items = '';
        $disabled = false;
        $handle = ($this->showHandle) ? Html::tag('span', $this->handleLabel, ['class' => 'handle']) : '';
        foreach ($this->items as $item) {
            $options = ArrayHelper::getValue($item, 'options', []);
            $options = ArrayHelper::merge($this->itemOptions, $options);
            if (ArrayHelper::getValue($item, 'disabled', false)) {
                Html::addCssClass($options, 'disabled');
            }
            $content = $handle . ArrayHelper::getValue($item, 'content', '');
            $items .= Html::tag('li', $content, $options) . PHP_EOL;
        }
        return $items;
    }

    /**
     * Register client assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SortableAsset::register($view);
        $this->registerPlugin('sortable');
        $id = 'jQuery("#' . $this->options['id'] . '")';
        if ($this->disabled) {
            $js = "{$id}.sortable('disable');";
        } else {
            $js = "{$id}.sortable('enable');";
        }
        $view->registerJs($js);
    }
}
